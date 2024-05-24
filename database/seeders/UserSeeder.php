<?php

namespace Database\Seeders;

use App\Models\Api\UserModel;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserModel::truncate();
        UserModel::factory()->count(50)->create();
    }
}
