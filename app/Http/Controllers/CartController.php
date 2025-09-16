<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Passes all the cart items from the DB to the cart view so we can display them
    public function index() {
        // Get all the cart items
        $cartItems = CartItem::all();

        // Do something with the users id to get only their cart items.
        // $userId = auth()->user()->id;

        // Filter the cartItems to where we return to the view only the currently logged in
        // users cart items
        $userCartItems = $cartItems->filter(function ($cartItem) {
            return $cartItem->user_id === auth()->id();
        });

        // Lastly we can calculate the total price of the users cart
        // and then return the view with the data.
        $cartTotalPrice = number_format($this->calcCartTotalPrice($userCartItems), 2);

        return view('cart', compact('userCartItems', 'cartTotalPrice'));
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
        $userId = auth()->id();

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
                'quantity' => $quantity
            ]);
        }

        // 5. Flash a success message to the user and then redirect back to the menu
        return redirect('/menu')->with('success', "Item added to cart successfully!");


        // return redirect()->back()->with('success', 'Item added to cart!');
    }

    // Removes a cartItem from the CartItems DB
    public function destroy($id) {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return redirect('/cart');
    }

    public function decrementQuantity($id) {
        CartItem::findOrFail($id)->decrement('quantity');
        return redirect('/cart');
    }

    public function incrementQuantity($id) {
        CartItem::findOrFail($id)->increment('quantity');
        return redirect('/cart');
    }

    private function calcCartTotalPrice($userCartItems) {
        $totalPrice = 0;

        // sum up all the cart items to find a total price
        foreach($userCartItems as $userCartItem) {
            $totalPrice += $userCartItem->quantity * $userCartItem->menuItem->price;
        }

        return $totalPrice;
    }
}
