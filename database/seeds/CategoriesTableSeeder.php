<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Schools',
                'color' => '#FF0000',
            ],
            [
                'name' => 'Kindergartens',
                'color' => '#00FF00',
            ],
            [
                'name' => 'Social Child Projects',
                'color' => '#0000FF',
            ],
            [
                'name' => 'Social Teenage Projects',
                'color' => '#FF00FF',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
