<nav class="flex justify-end gap-4 w-full h-16 p-4 text-lg bg-opacity-100 sticky top-0">

    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
        Home
    </x-nav-link>

    <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
        About
    </x-nav-link>

    <x-nav-link :href="route('menu')" :active="request()->routeIs('menu')">
        Menu
    </x-nav-link>

    {{-- Conditionally render the cart icon with the @auth directive if the user is logged in --}}
    <x-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
    </x-nav-link>

    <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
        Register
    </x-nav-link>

    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
        Login
    </x-nav-link>

    <x-nav-link :href="route('logout')" :active="request()->routeIs('logout')">
        Logout
    </x-nav-link>

    {{-- @auth
        <a href="/"></a>
        <a href="/menu"></a>
        <a href="/cart"></a>
        <a href="/logout"></a>
    @else
        <a href="/"></a>
        <a href="/menu"></a>
        <a href="/cart"></a>
        <a href=""></a>
    @endauth --}}
</nav>