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

    // These are the relationships that a cartItem has.
    // You can reference them when you need to know what user
    // a cartItem is associated with, or what menuItem it is associated with.
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function menuItem() {
        return $this->belongsTo(MenuItem::class);
    }
}
