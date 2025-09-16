{{-- New attempt at the navbar, but this time we want two rows of navlinks --}}


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