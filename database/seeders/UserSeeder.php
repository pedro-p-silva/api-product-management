<?php

namespace Database\Seeders;

use App\Models\Api\UserModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    private function dataUsers(): array
    {
        return [
            [
                'name' => 'Pedro Paulo de Souza Silva',
                'email' => 'pedro.paulo.s@outlook.com.br',
                'password' => Hash::make('Pedro@2314'),
                'status' => 1
            ],

            [
                'name' => 'Natacha Alves',
                'email' => 'natacha.test@gmail.com',
                'password' => Hash::make('Pedro@2314'),
                'status' => 1
            ],

            [
                'name' => 'Matteo Silva',
                'email' => 'matt.alves@gmail.com',
                'password' => Hash::make('Pedro@2314'),
                'status' => 2
            ],

            [
                'name' => 'Akaminosflaudo Santos Borges',
                'email' => 'akami.s@terra.com',
                'password' => Hash::make('Pedro@2314'),
                'status' => 2
            ],

            [
                'name' => 'Api Manage Products',
                'email' => 'aplicacao.test@gmail.com',
                'password' => Hash::make('Pedro@2314'),
                'status' => 5
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
        UserModel::truncate();

        foreach ($this->dataUsers() as $dataUser) {
            UserModel::create(
                [
                    'name' => $dataUser['name'],
                    'email' => $dataUser['email'],
                    'password' => $dataUser['password'],
                    'status' => $dataUser['status']
                ]
            );
        }
    }
}
