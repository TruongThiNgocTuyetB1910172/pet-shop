<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
           'email' => 'admin@gmail.com',
           'password' => Hash::make('admin123'),
           'name' => 'Tuyet Truong',
           'status' => 1,
           'is_admin' => 1,
           'is_root' => 1,
           'email_verified_at' => Carbon::now(),
           'phone' => fake()->phoneNumber(),
        ]);
    }
}
