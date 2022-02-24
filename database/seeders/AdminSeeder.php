<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

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
            'uuid'         => Str::uuid(),
            'first_name'   => 'Buckhill',
            'last_name'    => 'Admin',
            'email'        => 'admin@buckhill.co.uk',
            'is_admin'     => 1,
            'password'     => Hash::make('admin'),
            'is_marketing' => 0,
        ];

        User::create($admin);
    }
}
