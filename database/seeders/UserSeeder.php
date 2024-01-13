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
            "name" => "Anggun",
            "email" => "Anggun@gmail.com",
            "password" => bcrypt("123456"),
            "level" => "admin",

        ],
        [
            "name" => "Afy",
            "email" => "Afy@gmail.com",
            "password" => bcrypt("123456"),
            "level" => "admin",

        ],
        [
            "name" => "Yunita",
            "email" => "Yunita@gmail.com",
            "password" => bcrypt("123456"),
            "level" => "user",

        ]
        ];
        foreach ($users as $user){
            User::create($user);
        }
    
    }
}
