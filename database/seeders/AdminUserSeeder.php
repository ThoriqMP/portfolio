<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Temukan user admin dan reset password-nya menjadi 'password'
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Thoriq',
                'email' => 'thoriqpasya860@gmail.com',
                'email_contact' => 'thoriqpasya860@gmail.com',
                'password' => Hash::make('password'),
            ]
        );
    }
}
