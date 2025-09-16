{{-- We are getting menuItems from the mysql database with our Eloquent Model: MenuItem --}}
<x-layout>
    <main class="flex flex-col gap-4 text-gray-100 p-8">
        <h1 class="text-3xl">Menu</h1>
        {{-- Here we can use the @guest directive to conditionally render
        to suggest to the user to log in if they want to add items to their cart --}}
        @guest
            <h2 class="text-3xl font-extrabold text-center py-16">Please register or login if you would like to order some coffee!</h2>
        @endguest
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-16">
            @foreach ($menuItems as $menuItem)
                <div class="flex flex-col justify-center items-center gap-4 text-center">
                    <img class="rounded-full w-lg" src="/images/{{ $menuItem->imageURL }}" alt="{{ $menuItem->name }}">
                    <p>{{ $menuItem->name }} - ${{ $menuItem->price }}</p>
                    <p>{{ $menuItem->description }}</p>
                    {{-- This form sends a request to the add method in the CartController --}}
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="menuItemId" value="{{ $menuItem->id }}">
                        <input type="hidden" name="quantity" value="1">
                        @auth
                            <button type="submit" class="border border-white py-2 px-8 rounded-xl hover:bg-blue-500 hover:text-white">
                                Add to cart
                            </button>
                        @endauth
                    </form>
                </div>
            @endforeach
        </div>
    </main>
</x-layout>