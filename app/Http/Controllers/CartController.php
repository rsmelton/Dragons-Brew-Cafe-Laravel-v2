<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Passes all the cart items from the DB to the cart view so we can display them
    public function index() {
        $cartItems = CartItem::all();
        return view('cart', compact('cartItems'));
    }
    
    // Method that allows the user to add an item to their cart from the menu view
    public function add(Request $request) {

        // 1. Validate form data
        $request->validate([
            'menuItemId' => 'required|exists:menu_items,id',
            'quantity' => 'required|integer|min:1|max:1'
        ]);

        // 2. Get the form data
        $menuItemId = $request->menuItemId;
        $quantity = $request->quantity;
        // Hard coded for now just to test with a single user
        // Later change it to the commented version below it
        $userId = 1;
        // $userId = auth()->id();

        // 3. Find the menu item by its id so we can use its price for the cart item when we create it.
        $menuItem = MenuItem::find($menuItemId);

        // 4. Check if the item already exists in the users cart. 
        $existingCartItem = CartItem::where('user_id', $userId)
                                    ->where('menu_item_id', $menuItemId)
                                    ->first();

        if ($existingCartItem) {
            // If the cart item exists then we want to update the quantity
            $existingCartItem->quantity += $quantity;
            $existingCartItem->save();
        } else {
            // Otherwise we can create the new cart item
            CartItem::create([
                'user_id' => $userId,
                'menu_item_id' => $menuItemId,
                'quantity' => $quantity,
                'price' => $menuItem->price
            ]);
        }

        // 5. Flash a success message to the user and then redirect back to the menu
        return redirect('/menu')->with('success', "Item added to cart successfully!");


        // return redirect()->back()->with('success', 'Item added to cart!');
    }
}
