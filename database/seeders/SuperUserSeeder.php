<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            "name" => "Super",
            "email" => "super@super.test",
            "password" => Hash::make("super"),
            "phone" => "123123123",
        ]);
        $user->roles()->attach(["super"]);
    }
}
