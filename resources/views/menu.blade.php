@extends('layouts.layout')

@section('content')
    <main class="flex flex-col gap-4 text-gray-100 p-8">
        <h1 class="text-3xl">Menu</h1>
        @guest
            <h2 class="text-3xl font-extrabold text-center py-16">
                Please register or login if you would like to order some coffee!
            </h2>
        @endguest
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-16">
            {{-- We get $menuItems from the index menu controller method --}}
            @foreach ($menuItems as $menuItem)
                <div class="flex flex-col justify-center items-center gap-4 text-center">
                    <img class="rounded-full w-lg p-4" src="/images/{{ $menuItem->imageURL }}" alt="{{ $menuItem->name }}">
                    <p>{{ $menuItem->name }} - ${{ $menuItem->price }}</p>
                    <p>{{ $menuItem->description }}</p>

                    @auth
                        {{-- This calls the addToCart method inside my cartHandler.js file --}}
                        <button x-data @click="$store.cart.addToCart({{ $menuItem->id }})" 
                                class="border border-white py-2 px-8 rounded-xl hover:bg-blue-500 hover:text-white"
                        >
                            Add to cart
                        </button>
                    @endauth

                </div>
            @endforeach
        </div>
    </main>
@endsection