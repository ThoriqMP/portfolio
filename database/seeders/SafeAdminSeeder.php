<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SafeAdminSeeder extends Seeder
{
    /**
     * Run the database seeds safely.
     * 
     * Seeder ini:
     * 1. TIDAK menghapus data apapun (project, education, experience, badge, social, dll).
     * 2. TIDAK menimpa profil (nama, bio, title, avatar) jika user admin sudah ada.
     * 3. Hanya mereset password menjadi 'password' (atau membuat akun baru jika belum ada).
     */
    public function run(): void
    {
        $user = User::where('username', 'admin')->first() ?? User::first();

        if ($user) {
            // Hanya update password tanpa mengubah data profil (name, bio, title, avatar, dll)
            $user->update([
                'password' => Hash::make('password'),
            ]);

            $this->command->info("Password untuk user '{$user->username}' berhasil direset menjadi 'password' (Data profil & data lainnya tetap aman).");
        } else {
            // Jika belum ada user sama sekali di database, buat user default
            User::create([
                'username' => 'admin',
                'name' => 'Admin',
                'title' => 'Web Developer',
                'bio' => '',
                'password' => Hash::make('password'),
            ]);

            $this->command->info("Akun admin baru berhasil dibuat (username: admin, password: password).");
        }
    }
}
