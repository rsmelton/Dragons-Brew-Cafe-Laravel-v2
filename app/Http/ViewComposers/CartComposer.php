<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

// This file is not in use anymore, need to delete eventually, but will keep for now in case. 

class CartComposer
{
    public function compose(View $view)
    {
        $cartQuantity = 0;

        if (Auth::check()) {
            $cartQuantity = CartItem::where('user_id', Auth::id())->sum('quantity');
        }

        $view->with('cartQuantity', $cartQuantity);
    }
}
