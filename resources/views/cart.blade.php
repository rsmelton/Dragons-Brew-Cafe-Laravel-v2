{{-- Anything in this file using $store.cart is referencing a global store that is stored in Alpine 
which is inside my cartHandler.js file --}}

@extends('layouts.layout')

@section('content')
    {{-- $store.cart.updateCart() is giving the latest items in the cart so we can update them
    and also view them reactively. This must be called at the highest level so we get the latest cart data --}}
    <main x-init="$store.cart.updateCart()" class="flex flex-col gap-4 text-gray-100 p-8">
        <h1 class="text-3xl">Cart</h1>

        {{-- Conditionally render an empty cart page if there are no items in the users cart --}}
        <template x-if="$store.cart.cartTotalQuantity === 0">
            <div class="flex flex-col justify-center items-center gap-4">
                <p class="text-2xl">Your cart is currently empty</p>
                <p class="text-2xl">Please click the button below to navigate to the menu to start adding items to your cart.</p>
                <a href="/menu">
                    <button class="border border-white py-2 px-8 rounded-xl hover:bg-blue-500 hover:text-white text-xl">Go to menu</button>
                </a>
            </div>
        </template>

        {{-- Otherwise we render out the users cart --}}
        <template x-if="$store.cart.cartTotalQuantity > 0">
            <div>
                <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">Change Quantity</th>
                            <th class="px-6 py-3">Item Name</th>
                            <th class="px-6 py-3">Price per item</th>
                            <th class="px-6 py-3">Quantity</th>
                            <th class="px-6 py-3 text-right">Cost</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-gray-300">
                        <template x-for="cartItem in $store.cart.cartItems" :key="cartItem.id">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap items-center gap-2">
                                        {{-- If there is only 1 of a cart item left then we display 
                                        the trash can icon to allow it to be fully removed --}}
                                        <template x-if="cartItem.quantity === 1">
                                            <button @click="$store.cart.deleteFromCart(cartItem.id)" class="bg-red-500 text-blue-800 px-2 py-1 rounded text-xs">
                                                <img style="width: 2.5rem; height: 2.5rem;" src="/images/trashcan-icon.png" alt="Decrease quantity from cart button">
                                            </button>
                                        </template>
                                        {{-- If the quantity of the cart item is more than 1 then we can 
                                        display a minus button to allow the item to be decremented --}}
                                        <template x-if="cartItem.quantity > 1">
                                            <button @click="$store.cart.decrementQuantity(cartItem.id)" class="bg-red-500 text-blue-800 px-2 py-1 rounded text-xs">
                                                <img style="width: 2.5rem; height: 2.5rem;" src="/images/minus-icon.png" alt="Decrease quantity from cart button">
                                            </button>
                                        </template>
                                        {{-- Display the quantity of the current cart item --}}
                                        <span x-text="cartItem.quantity" class="text-black px-4 py-1 rounded text-xl"></span>
                                        {{-- Display a plus icon to allow items to be added to the cart --}}
                                        <button @click="$store.cart.incrementQuantity(cartItem.id)" class="bg-green-400 text-blue-800 px-2 py-1 rounded text-xs">
                                            <img style="width: 2.5rem; height: 2.5rem;" src="/images/plus-icon.png" alt="Increase quantity from cart button">
                                        </button>
                                    </div>
                                </td>
                                <td x-text="cartItem.menuItem.name" class="px-6 py-4 font-medium text-gray-800"></td>
                                <td x-text="`$${cartItem.menuItem.price}`" class="px-6 py-4 text-gray-600"></td>
                                <td x-text="cartItem.quantity" class="px-6 py-4 text-gray-800"></td>
                                <td x-text="`$${(cartItem.menuItem.price * cartItem.quantity).toFixed(2)}`" class="px-6 py-4 text-gray-800 text-right space-x-2"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <p x-text="`Total: $${ $store.cart.cartTotalPrice }`" class="text-right pt-4 text-2xl"></p>
            </div>
        </template>
    </main>
@endsection