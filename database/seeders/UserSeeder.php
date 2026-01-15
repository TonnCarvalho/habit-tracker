<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'Cleiton Carvalho',
            'email' => 'cleiton_601@hotmail.com',
            'password' => '123456'
        ]);
    }
}
