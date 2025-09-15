<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the fields for the menu items
        // Then try connecting to the database and see those fields
        // Then we can try and set those fields in the database maybe manually
        // Then try creating the Model for the menu items 
        // There also has to be some relationships between the menu items and the cart
        // and then the cart has a relationship with the user
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('imageURL');
            $table->string('name');
            $table->float('price');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
