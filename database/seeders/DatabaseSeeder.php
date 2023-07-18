<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' =>'khon hein',
            'email' =>'admin@gmail.com',
            'phone' =>'09893102188',
            'gender' =>'male',
            'address' =>'pinlebu',
            'role' =>'admin',
            'password' =>Hash::make('admin1234')
        ]);
    }
}
