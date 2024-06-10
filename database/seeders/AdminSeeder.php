<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'CompanyName' => 'Gm-Soft',
            'telephone' => '0650095811',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminadmin'), // Make sure to hash the password
            'role' => 'Derictor', 
            'isactive' => 1,
            'profile' => '123.jpg' 
        ]);
    }
}
