<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "Normal User",
            "email" => "normal@gmail.com",
            "password" => Hash::make("123456"),
            "status" => "active",
            "role" => "user",
            "country_id" => 1,
            "state_id" => 1,
            "city_id" => 1,
        ]);
        User::create([
            'name' => "Manager User",
            "email" => "manager@gmail.com",
            "password" => Hash::make("123456"),
            "status" => "active",
            "role" => "manager",
            "country_id" => 1,
            "state_id" => 1,
            "city_id" => 1,
        ]);
    }
}
