<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categoryNames = [
            "art",
            "music",
            "sience",
            "history",
            "litterature",
            "videogame",
            "computer",
            "development",
            "bool",
            "funny",
        ];
        foreach ($categoryNames as $categoryName) {
            $category = new Category();
            $category->name = $categoryName;
            $category->color = $faker->hexColor();       
            $category->save();
        }
    }
}
