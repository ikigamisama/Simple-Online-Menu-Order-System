<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\MenuItem;

class MenuItemSeeder extends Seeder
{
    public function __CONSTRUCT() {
        $this->id = 1;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_items')->delete();
        DB::unprepared("ALTER TABLE menu_items AUTO_INCREMENT = 1");

        $items = array(
            array(
                "id" => $this->id++,
                'category_id' => "1",
                'item' => 'Hotdog',
                'image' => 'hotdog.png',
                'price' => 71.00,
            ),
            array(
                "id" => $this->id++,
                'category_id' => "1",
                'item' => 'CheeseBurger',
                'image' => 'cheeseburger.png',
                'price' => 61.00,
            ),
            array(
                "id" => $this->id++,
                'category_id' => "1",
                'item' => 'Fries',
                'image' => 'fries.png',
                'price' => 55.00,
            ),
            array(
                "id" => $this->id++,
                'category_id' => "2",
                'item' => 'Coke',
                'image' => 'coke.png',
                'price' => 47.00,
            ),
            array(
                "id" => $this->id++,
                'category_id' => "2",
                'item' => 'Sprite',
                'image' => 'sprite.png',
                'price' => 47.00,
            ),
            array(
                "id" => $this->id++,
                'category_id' => "2",
                'item' => 'Tea',
                'image' => 'tea.png',
                'price' => 57.00,
            ),
            array(
                "id" => $this->id++,
                'category_id' => "3",
                'item' => 'Chicken Combo Meal',
                'image' => 'chicken-combo-meal.png',
                'price' => 89.00,
            ),
            array(
                "id" => $this->id++,
                'category_id' => "3",
                'item' => 'Pork Combo',
                'image' => 'pork-combo.png',
                'price' => 125.00,
            ),
            array(
                "id" => $this->id++,
                'category_id' => "3",
                'item' => 'Fish Combo',
                'image' => 'fish-combo.png',
                'price' => 110.00,
            )
        );

        foreach($items as $menuItem){
            MenuItem::create($menuItem);
        }
    }
}
