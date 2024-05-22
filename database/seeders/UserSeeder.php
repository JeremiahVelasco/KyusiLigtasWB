<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Dispatcher',
                'email' => 'dispatcher@kyusiligtas.com',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Fire Responder',
                'email' => 'fireresponder@kyusiligtas.com',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Medical Responder',
                'email' => 'medicalresponder@kyusiligtas.com',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Head',
                'email' => 'head@kyusiligtas.com',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@kyusiligtas.com',
                'password' => bcrypt('password')
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
