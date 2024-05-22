<?php

namespace Database\Seeders;

use App\Models\Api\StatusModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{

    private function dataStatus(): array
    {
        return [
            [
                'name' => 'Ativo',
            ],

            [
                'name' => 'Inativo',
            ],

            [
                'name' => 'Bloqueado',
            ],

            [
                'name' => 'Licença Maternidade',
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        StatusModel::truncate();

        foreach ($this->dataStatus() as $status) {
            StatusModel::create([
                'name' => $status['name']
            ]);
        }
    }
}
