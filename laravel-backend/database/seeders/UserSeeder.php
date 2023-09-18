<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var User $user */
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@jobtraq.hu',
            'password' => Hash::make('test-user-123'),
        ]);

        $user->assignRole('Adminisztrátor');
    }
}
