<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        $date = Carbon::create(2022);
        $promotions = [
            [
                "uuid" => Str::uuid(),
                "title" => "New products in stock",
                "content" => "Alice; 'it's laid for a minute or two she stood looking at it again: but he would deny it too: but the Hatter said, turning to Alice: he.",
                "metadata" => [
                    "valid_from" => $date->format('Y-m-d'),
                    "valid_to" => $date->addWeeks(random_int(1, 52))->format('Y-m-d'),
                    "image" => Str::uuid()
                ],
            ],
            [
                "uuid" => Str::uuid(),
                "title" => "Brand of the week",
                "content" => "Queen, pointing to Alice an excellent opportunity for showing off her knowledge, as there seemed to be no doubt that it would not give all.",
                "metadata" => [
                    "valid_from" => $date->format('Y-m-d'),
                    "valid_to" => $date->addWeeks(random_int(1, 52))->format('Y-m-d'),
                    "image" => Str::uuid()
                ],
            ],
            [
                "uuid" => Str::uuid(),
                "title" => "Find articles under 25 USD",
                "content" => "I suppose it were nine o'clock in the world! Oh, my dear Dinah! I wonder if I've kept her waiting!' Alice felt that it was quite pale.",
                "metadata" => [
                    "valid_from" => $date->format('Y-m-d'),
                    "valid_to" => $date->addWeeks(random_int(1, 52))->format('Y-m-d'),
                    "image" => Str::uuid()
                ],
            ],
        ];

        collect($promotions)->each(function ($promotion) {
            Promotion::create($promotion);
        });
    }
}
