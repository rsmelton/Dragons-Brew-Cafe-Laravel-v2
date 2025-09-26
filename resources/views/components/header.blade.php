{{-- New attempt at the navbar, but this time we want two rows of navlinks --}}
<nav {{ $attributes->merge(['class' => 'w-full h-16 p-2 text-lg bg-opacity-100 sticky top-0']) }}>
    <div class="flex justify-end gap-2">
        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
            Home
        </x-nav-link>

        <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
            About
        </x-nav-link>

        <x-nav-link :href="route('menu')" :active="request()->routeIs('menu')">
            Menu
        </x-nav-link>

        @auth
            <x-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
                <div x-init="$store.cart.updateCart()">
                    <i class="fa fa-shopping-cart inline-block text-sm" aria-hidden="true"></i>
                    {{-- This value comes from the field in the cartHandler.js file --}}
                    <span x-text="$store.cart.cartTotalQuantity"></span>
                </div>
            </x-nav-link>
        @endauth
    </div>
    <div class="flex justify-end gap-2">
        @guest
            <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                Register
            </x-nav-link>

            <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                Log in
            </x-nav-link>
        @endguest

        @auth
            {{-- <x-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
                <i class="fa fa-shopping-cart inline-block text-xl" aria-hidden="true"></i>
                {{ $cartQuantity }}
            </x-nav-link> --}}

            <x-nav-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-nav-link>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}" class="flex justify-start">
                @csrf

                <x-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-nav-link>
            </form>
        @endauth

    </div>
</nav>


{{-- Old code that works, but the nav links are all on the same row--}}
{{-- <nav {{ $attributes->merge(['class' => 'flex flex-wrap justify-end gap-4 w-full h-16 p-4 text-lg bg-opacity-100 sticky top-0']) }}>

    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
        Home
    </x-nav-link>

    <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
        About
    </x-nav-link>

    <x-nav-link :href="route('menu')" :active="request()->routeIs('menu')">
        Menu
    </x-nav-link>

    @guest
        <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
            Register
        </x-nav-link>

        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
            Log in
        </x-nav-link>
    @endguest

    @auth
        <x-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
            <i class="fa fa-shopping-cart inline-block text-xl" aria-hidden="true"></i>
            {{ $cartQuantity }}
        </x-nav-link>

        <x-nav-link :href="route('profile.edit')">
            {{ __('Profile') }}
        </x-nav-link>

        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}" class="flex justify-start">
            @csrf

            <x-nav-link :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-nav-link>
        </form>
    @endauth
</nav>
--}}