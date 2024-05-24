<?php

namespace Database\Seeders;

use App\Models\Api\StatusModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        StatusModel::truncate();
        StatusModel::factory()->count(5)->create();
    }
}
