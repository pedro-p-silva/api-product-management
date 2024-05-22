<?php

namespace Database\Seeders;

use App\Models\Api\ProductModel;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    private function dataProduct(): array
    {
        return [
            [
                "name" => "Coleira para cachorro",
                "description" => "Confortável, com boa regulagem.",
                "category" => 2,
                "quantity" => 120,
                "manufacturer" => "Petz",
                "photo_path" => "public/product_image/SeederTest 13.05.24_1715731505.jpeg",
                "status" => 1
            ],

            [
                "name" => "Site e-commerce",
                "description" => "Um site criado exatamente para o seu negócio!",
                "category" => 1,
                "quantity" => 5,
                "manufacturer" => "DevStorm",
                "photo_path" => "public/product_image/SeederTestTwo 13.05.24_1715731505.jpeg",
                "status" => 1
            ]
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductModel::truncate();

        foreach ($this->dataProduct() as $product) {
            ProductModel::create([
                "name" => $product['name'],
                "description" => $product['description'],
                "category" => $product['category'],
                "quantity" => $product['quantity'],
                "manufacturer" => $product['manufacturer'],
                "photo_path" => $product['photo_path'],
                "status" => $product['status']
            ]);
        }
    }
}
