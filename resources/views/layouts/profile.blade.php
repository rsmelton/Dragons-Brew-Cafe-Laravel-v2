<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Dragon's Brew Cafe</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/userCartItem.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen p-4" style="background-color: #0e1d3e">
            {{-- @include('layouts.navigation') --}}
            <x-header :cartQuantity=$cartQuantity />

            <!-- Page Heading -->
            {{-- @isset($header)
                <header class="shadow">
                    <div class="max-w-7xl py-6 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                    <h1>{{ $header }}</h1>
                </header>
            @endisset --}}

            <!-- Page Content -->
            <main id="scrollable-content" class="overflow-auto h-[calc(100vh-5rem)] relative z-0">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
