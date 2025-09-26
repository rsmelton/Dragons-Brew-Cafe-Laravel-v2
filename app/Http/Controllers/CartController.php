<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Passes the number of items in the cart and the total price of that cart back to the cart view
    public function index() {

        // Get all the users cart items so we can figure out how many there are
        $userCartItems = CartItem::where('user_id', auth()->id())->get();

        // Calculate the total price of the users cart
        $cartTotalPrice = number_format($this->calcCartTotalPrice($userCartItems), 2);

        // return the data to the view
        return view('cart', [
            'numItemsInUserCart' => $userCartItems->count(),
            'cartTotalPrice' => $cartTotalPrice
        ]);
    }

    public function updateCart() {
        // Get all the users cart items so we can figure out how many there are
        $userCartItems = CartItem::where('user_id', auth()->id())->get();

        // Calculate the total price of the users cart
        $cartTotalPrice = number_format($this->calcCartTotalPrice($userCartItems), 2);

        // Sum up all the items in the users cart
        $cartTotalQuantity = $this->findCartTotalQuantityOfUser($userCartItems);

        // Make some json data for each cart item so we can get all the 
        // necessary data we need from it
        $userCartItemsJson = $userCartItems->map(function ($cartItem) {
            return [
                'id' => $cartItem->id,
                'quantity' => $cartItem->quantity,
                'menuItem' => [
                    'name' => $cartItem->menuItem->name,
                    'price' => $cartItem->menuItem->price,
                ],
            ];
        });

        return response()->json([
            'cartItems' => $userCartItemsJson,
            'cartTotalPrice' => $cartTotalPrice,
            'cartTotalQuantity' => $cartTotalQuantity
        ]);
    }
    
    // Method that allows the user to add an item to their cart from the menu view
    public function store(Request $request) {

        // 1. Validate given data from cartHandler.js
        $request->validate([
            'menuItemId' => 'required|exists:menu_items,id',
            'quantityToAdd' => 'required|integer|min:1|max:1'
        ]);

        // 2. Get the data from the body of the request in cartHandler.js addToCart method
        $menuItemId = $request->input('menuItemId');
        $quantityToAdd = $request->input('quantityToAdd');
        $userId = auth()->id();

        // 3. Check if the item already exists in the users cart. 
        $existingCartItem = CartItem::where('user_id', $userId)
                                    ->where('menu_item_id', $menuItemId)
                                    ->first();

        if ($existingCartItem) {
            // If the cart item exists then we want to update the quantity
            $existingCartItem->quantity += $quantityToAdd;
            $existingCartItem->save();
        } else {
            // Otherwise we can create the new cart item
            CartItem::create([
                'user_id' => $userId,
                'menu_item_id' => $menuItemId,
                'quantity' => $quantityToAdd
            ]);
        }

        // return the total quantity of the users cart
        // return $this->getQuantity();
        return $this->updateCart();
    }

    // Removes a cartItem from the CartItems DB
    public function destroy($id) {
        CartItem::findOrFail($id)->delete();
        return $this->updateCart();
    }

    // Increment a cart items quantity
    public function incrementQuantity($id) {
        CartItem::findOrFail($id)->increment('quantity');
        return $this->updateCart();
    }

    // Decrement a cart items quantity
    public function decrementQuantity($id) {
        CartItem::findOrFail($id)->decrement('quantity');
        return $this->updateCart();
    }

    // Private helper methods below this line -----

    private function getQuantity() {
        $userCartItems = CartItem::where('user_id', auth()->id())->get();

        $totalCartQuantity = $this->findCartTotalQuantityOfUser($userCartItems);

        return response()->json([
            'quantity' => $totalCartQuantity
        ]);
    }

    private function findCartTotalQuantityOfUser($userCartItems) {
        return $userCartItems->sum('quantity');
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
