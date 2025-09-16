<?php

namespace App\Models;

use App\Models\User;
use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';

    protected $fillable = [
        'user_id',
        'menu_item_id',
        'quantity'
    ];

    // Relationship that tells laravel that cart items belong to a User
    // this is essentially just returning a relationship object to then use
    // later if I need to find the user associated with this cart item
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function menuItem() {
        return $this->belongsTo(MenuItem::class);
    }
}
