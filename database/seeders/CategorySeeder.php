<?php

namespace Database\Seeders;

use App\Models\Api\CategoryModel;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    private function dataCategory(): array
    {
        return [
            [
                'name' => 'Serviços Tecnológicos',
                'status' => 1
            ],

            [
                'name' => 'Pets',
                'status' => 1
            ],

            [
                'name' => 'Higiene Pessoal',
                'status' => 2
            ],

            [
                'name' => 'Eletrodomésticos',
                'status' => 2
            ],

        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryModel::truncate();

        foreach ($this->dataCategory() as $category) {
            CategoryModel::create([
                'name' => $category['name'],
                'status' => $category['status']
            ]);
        }
    }
}
