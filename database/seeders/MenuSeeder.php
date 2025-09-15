<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    // Since my menu data will likely never change we can
    // simply have this file insert all the data into the menuitems table

    // Command to seed database: php artisan db:seed --class=MenuSeeder
    public function run(): void
    {
        DB::table('menu_items')->insert([
            [
                'imageURL' => 'dragonsFireLatte.png',
                'name' => "Dragon's Fire Latte",
                'price' => 7.95,
                'description' => 'A spicy twist on a classic latte with a hint of cinnamon and cayenne pepper, topped with a good amount of whipped cream',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'imageURL' => 'enchantedEspresso.png',
                'name' => "Enchanted Espresso",
                'price' => 4.95,
                'description' => 'A double shot of our finest espresso, served with a twist of lemon and a sprinkling of enchanted edible glitter upon request',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'imageURL' => 'frostDragonLatte.png',
                'name' => "Frost Dragon Latte",
                'price' => 6.95,
                'description' => 'A freezing cold latte with mint and white chocolate with some whipped cream on top and a drizzle of caramel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'imageURL' => 'mysticMatcha.png',
                'name' => "Mystic Matcha",
                'price' => 7.99,
                'description' => 'A vibrant green matcha latte with a touch of vanilla and honey with whipped cream on top, served with a side of mochi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'imageURL' => 'phoenixFrappuccino.png',
                'name' => "Phoenix Frappuccino",
                'price' => 7.95,
                'description' => 'A cool, blended drink with flavors of mango, raspberry, and a hint of chili, topped with whipped cream and a fiery chocolate drizzle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'imageURL' => 'sorcerersSmoresMocha.png',
                'name' => "Sorcerer's Smores Mocha",
                'price' => 8.95,
                'description' => 'A decadent mocha with toasted marshmallow, graham cracker crumbles, and chocolate drizzle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'imageURL' => 'unicornColdBrew.png',
                'name' => "Unicorn Cold Brew",
                'price' => 3.95,
                'description' => 'A magical cold brew coffee infused with lavender and vanilla, served with a swirl of pastel-colored cream on the top',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'imageURL' => 'wizardsWhiteChocolateMocha.png',
                'name' => "Wizard's White Chocolate Mocha",
                'price' => 6.95,
                'description' => 'A creamy white chocolate mocha mixed with a hazelnut mocha topped with whipped cream and a drizzle of caramel and chocolate',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
