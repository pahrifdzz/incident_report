<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * UserSeeder - Create default admin and user accounts
 * Clean Architecture: Centralized user creation for development
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Create admin dan user default untuk testing
     */
    public function run(): void
    {
        // Buat admin user
        User::create([
            'name' => 'Admin System',
            'email' => 'admin@incident-report.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Buat user biasa untuk testing
        User::create([
            'name' => 'User Test',
            'email' => 'user@incident-report.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);

        $this->command->info('✅ Admin dan User berhasil dibuat!');
        $this->command->info('📧 Admin: admin@incident-report.com | Password: admin123');
        $this->command->info('📧 User: user@incident-report.com | Password: user123');
    }
}