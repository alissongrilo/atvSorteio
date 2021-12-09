<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Usuario1',
            'email' => 'usuario1@email.com.br',
            'password' => Hash::make('123456789'),
        ]);
        User::create([
            'name' => 'Usuario2',
            'email' => 'usuario2@email.com.br',
            'password' => Hash::make('123456789'),
        ]);
        User::create([
            'name' => 'Usuario3',
            'email' => 'usuario3@email.com.br',
            'password' => Hash::make('123456789'),
        ]);
        User::create([
            'name' => 'Usuario4',
            'email' => 'usuario4@email.com.br',
            'password' => Hash::make('123456789'),
        ]);
        User::create([
            'name' => 'Usuario5',
            'email' => 'usuario5@email.com.br',
            'password' => Hash::make('123456789'),
        ]);
        User::create([
            'name' => 'Usuario6',
            'email' => 'usuario6@email.com.br',
            'password' => Hash::make('123456789'),
        ]);
        User::create([
            'name' => 'Usuario7',
            'email' => 'usuario7@email.com.br',
            'password' => Hash::make('123456789'),
        ]);
        User::create([
            'name' => 'Usuario8',
            'email' => 'usuario8@email.com.br',
            'password' => Hash::make('123456789'),
        ]);
    }
}