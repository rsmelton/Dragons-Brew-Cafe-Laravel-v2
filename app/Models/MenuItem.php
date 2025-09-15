<?php

namespace App\Models;

use App\Models\CartItem;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table = 'menu_items';

    protected $fillable = [
        'imageUrl',
        'name',
        'price',
        'description'
    ];

    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }
}
