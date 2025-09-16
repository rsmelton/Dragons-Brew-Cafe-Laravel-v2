<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\CartComposer;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Apply to all views (including layouts)
        View::composer('*', CartComposer::class);
    }

    public function register(): void
    {
        //
    }
}
