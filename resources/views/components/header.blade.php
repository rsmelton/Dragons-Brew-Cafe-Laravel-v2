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
                {{-- $store.cart is a global store in Alpine which is in the cartHandler.js file --}}
                <div x-init="$store.cart.getInitialCartTotalQuantity()">
                    <i class="fa fa-shopping-cart inline-block text-sm" aria-hidden="true"></i>
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