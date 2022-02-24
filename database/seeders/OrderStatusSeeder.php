<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                "uuid" => Str::uuid(),
                "title" => "cancelled",
            ],
            [
                "uuid" => Str::uuid(),
                "title" => "shipped",
            ],
            [
                "uuid" => Str::uuid(),
                "title" => "paid",
            ],
            [
                "uuid" => Str::uuid(),
                "title" => "pending payment",
            ]
        ];

        collect($statuses)->each(function ($status) {
            OrderStatus::create($status);
        });
    }
}
