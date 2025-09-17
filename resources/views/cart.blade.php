@extends('layouts.layout')

@section('content')
    <main class="flex flex-col gap-4 text-gray-100 p-8">
        <h1 class="text-3xl">Cart</h1>

        {{-- Conditionally render an empty cart page if there are no items in the users cart --}}
        @if ($userCartItems->count() === 0)
            <div class="flex flex-col justify-center items-center gap-4">
                <p class="text-2xl">Your cart is currently empty</p>
                <p class="text-2xl">Please click the button below to navigate to the menu to start adding items to your cart.</p>
                <a href="/menu">
                    <button class="border border-white py-2 px-8 rounded-xl hover:bg-blue-500 hover:text-white text-xl">Go to menu</button>
                </a>
            </div>
        @else
        {{-- Otherwise we render the users cart --}}
            <div>
                <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">Change Quantity</th>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Price per coffee</th>
                            <th class="px-6 py-3">Quantity</th>
                            <th class="px-6 py-3 text-right">Cost</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-gray-300">
                        @foreach ($userCartItems as $userCartItem)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap items-center gap-2">
                                        @if ($userCartItem->quantity === 1)
                                            <form action="{{ route('cart.destroy', $userCartItem->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="bg-red-500 text-blue-800 px-2 py-1 rounded text-xs">
                                                    <img style="width: 2.5rem; height: 2.5rem;" src="/images/trashcan-icon.png" alt="Decrease quantity from cart button">
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('cart.decrementQuantity', $userCartItem->id) }}" method="POST">
                                                @csrf

                                                <button type="submit" class="bg-red-400 text-blue-800 px-2 py-1 rounded text-xs">
                                                    <img style="width: 2.5rem; height: 2.5rem;" src="/images/minus-icon.png" alt="Decrease quantity from cart button">
                                                </button>
                                            </form>
                                        @endif
                                        <span class="bg-green-100 text-green-800 px-4 py-1 rounded text-xl">
                                            {{ $userCartItem->quantity }}
                                        </span>
                                        <form action="{{ route('cart.incrementQuantity', $userCartItem->id) }}" method="POST">
                                            @csrf

                                            <button type="submit" class="bg-green-400 text-blue-800 px-2 py-1 rounded text-xs">
                                                <img style="width: 2.5rem; height: 2.5rem;" src="/images/plus-icon.png" alt="Increase quantity from cart button">
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-800">{{ $userCartItem->menuItem->name }}</td>
                                <td class="px-6 py-4 text-gray-600">${{ $userCartItem->menuItem->price }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $userCartItem->quantity }}</td>
                                <td class="px-6 py-4 text-gray-800 text-right space-x-2">${{ number_format($userCartItem->quantity * $userCartItem->menuItem->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="text-right pt-4 text-2xl">Total: ${{ $cartTotalPrice }}</p>
            </div>
        @endif
    </main>
@endsection

{{-- <x-layout>
    <main class="flex flex-col gap-4 text-gray-100 p-8">
        <h1 class="text-3xl">Cart</h1>

        Conditionally render an empty cart page if there are no items in the users cart
        @if ($userCartItems->count() === 0)
            <div class="flex flex-col justify-center items-center gap-4">
                <p class="text-2xl">Your cart is currently empty</p>
                <p class="text-2xl">Please click the button below to navigate to the menu to start adding items to your cart.</p>
                <a href="/menu">
                    <button class="border border-white py-2 px-8 rounded-xl hover:bg-blue-500 hover:text-white text-xl">Go to menu</button>
                </a>
            </div>
        @else
        Otherwise we render the users cart
            <div>
                <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">Change Quantity</th>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Price per coffee</th>
                            <th class="px-6 py-3">Quantity</th>
                            <th class="px-6 py-3 text-right">Cost</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-gray-300">
                        @foreach ($userCartItems as $userCartItem)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap items-center gap-2">
                                        @if ($userCartItem->quantity === 1)
                                            <form action="{{ route('cart.destroy', $userCartItem->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="bg-red-500 text-blue-800 px-2 py-1 rounded text-xs">
                                                    <img style="width: 2.5rem; height: 2.5rem;" src="/images/trashcan-icon.png" alt="Decrease quantity from cart button">
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('cart.decrementQuantity', $userCartItem->id) }}" method="POST">
                                                @csrf

                                                <button type="submit" class="bg-red-400 text-blue-800 px-2 py-1 rounded text-xs">
                                                    <img style="width: 2.5rem; height: 2.5rem;" src="/images/minus-icon.png" alt="Decrease quantity from cart button">
                                                </button>
                                            </form>
                                        @endif
                                        <span class="bg-green-100 text-green-800 px-4 py-1 rounded text-xl">
                                            {{ $userCartItem->quantity }}
                                        </span>
                                        <form action="{{ route('cart.incrementQuantity', $userCartItem->id) }}" method="POST">
                                            @csrf

                                            <button type="submit" class="bg-green-400 text-blue-800 px-2 py-1 rounded text-xs">
                                                <img style="width: 2.5rem; height: 2.5rem;" src="/images/plus-icon.png" alt="Increase quantity from cart button">
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-800">{{ $userCartItem->menuItem->name }}</td>
                                <td class="px-6 py-4 text-gray-600">${{ $userCartItem->menuItem->price }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $userCartItem->quantity }}</td>
                                <td class="px-6 py-4 text-gray-800 text-right space-x-2">${{ number_format($userCartItem->quantity * $userCartItem->menuItem->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="text-right pt-4 text-2xl">Total: ${{ $cartTotalPrice }}</p>
            </div>
        @endif
    </main>
</x-layout> --}}