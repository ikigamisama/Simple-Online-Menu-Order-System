<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\MenuCategory;

class MenuCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
	public function __CONSTRUCT() {
        $this->id = 1;
    }
    public function run()
    {
        DB::table('menu_categories')->delete();
        DB::unprepared("ALTER TABLE menu_categories AUTO_INCREMENT = 1");

        $items = array(
            array(
                "id" => $this->id++,
                'category' => "Burgers",
                'image' => 'burgers.png'
            ),
            array(
                "id" => $this->id++,
                'category' => "Beverages",
                'image' => 'beverages.png'
            ),
            array(
                "id" => $this->id++,
                'category' => "Combo Meals",
                'image' => 'combo_meals.png'
            ),
        );

        foreach($items as $menuCategory){
            MenuCategory::create($menuCategory);
        }
    }
}
