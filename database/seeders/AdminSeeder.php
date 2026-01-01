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
            'name' => 'DolphiDay Admin',
            'email' => 'admin@dolphiday.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        
        $this->command->info('Admin account created successfully!');
        $this->command->info('Email: admin@dolphiday.com');
        $this->command->info('Password: password');
        $this->command->warn('Please change the password after first login!');
    }
}