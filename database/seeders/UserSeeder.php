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
        $data = [
            'name' => 'Admin',
            'level' => 0,
            'email' => 'admin@gmail.com',
            'password' => '123',
        ];
        User::create($data);

        $data = [
            'name' => 'Supper Admin',
            'level' => 1,
            'email' => 'sadmin@gmail.com',
            'password' => '123',
        ];
        User::create($data);
    }
}
