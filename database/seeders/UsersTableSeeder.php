<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use App\Models\User;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Nuzulul Masud',
            'identity_id' => '1820289',
            'gender' => 1,
            'address' => 'Ds. Kramat Jegu, Kec. Taman',
            'photo' => 'nuzul.jpg',
            'email' => 'nuzulul.m@sinarrodautama.co.id',
            'password' => app('hash')->make('secret'),
            'phone_number' => '085784406018',
            'api_token' => Str::random(40),
            'role' => 0,
            'status' => 1
        ]);
    }
}
