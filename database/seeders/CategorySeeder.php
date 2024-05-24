<?php

namespace Database\Seeders;

use App\Models\Api\CategoryModel;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryModel::truncate();
        CategoryModel::factory()->count(5)->create();
    }
}
