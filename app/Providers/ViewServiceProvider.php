<?php

namespace App\Providers;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\CartComposer;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Apply to all views (including layouts)
        // Old way, but was bad because it made too many SQL queries
        // View::composer('*', CartComposer::class);

        // New way that makes the query once and passes the data to the two layouts
        View::composer(['layouts.layout', 'layouts.app'], function ($view) {
            $cartQuantity = 0;

            if (Auth::check()) {
                $cartQuantity = CartItem::where('user_id', Auth::id())->sum('quantity');
            }

            $view->with('cartQuantity', $cartQuantity);
        });
    }

    public function register(): void
    {
        //
    }
}
