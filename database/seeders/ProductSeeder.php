<?php

namespace Database\Seeders;

use App\Models\Api\ProductModel;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductModel::truncate();
        ProductModel::factory()->count(50)->create();
    }
}
