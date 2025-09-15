{{-- We are getting menuItems from the mysql database with our Eloquent Model: MenuItem --}}
<x-layout>
    <main class="flex flex-col gap-4 text-gray-100 p-8">
        <h1 class="text-3xl">Menu</h1>
        {{-- Here we can use the @auth directive to conditionally render
             to suggest to the user to log in if they want to add items to their cart --}}
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
                        {{-- We will likely surround the button with the @auth directive here since
                             we only want the user to add something to their cart if they are logged in --}}
                        <button type="submit" class="border border-white py-2 px-8 rounded-xl hover:bg-blue-500 hover:text-white">
                            Add to cart
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </main>
</x-layout>