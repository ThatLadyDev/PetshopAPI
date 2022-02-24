<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'uuid' => Str::uuid(),
            'first_name' => 'Buckhill',
            'last_name' => 'Admin',
            'email' => 'admin@buckhill.co.uk',
            'is_admin' => 1,
            'password' => Hash::make('admin'),
            'is_marketing' => 0,
        ];

        User::create($admin);
    }
}
