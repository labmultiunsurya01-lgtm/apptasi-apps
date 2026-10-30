<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $email = 'admin@apptasi.or.id';
        $password = env('ADMIN_DEFAULT_PASSWORD', 'admin12345');

        User::updateOrCreate(
            ['email' => $email],
            [
                'name'     => 'Administrator APPTASI',
                'password' => Hash::make($password),
                'role'     => 'superadmin',
            ]
        );
    }
}
