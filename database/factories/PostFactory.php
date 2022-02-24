<?php

namespace Database\Factories;

use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition()
    {
        $title = $this->faker->sentence;

        $post = collect($this->faker->paragraphs(random_int(5, 15)))->toArray();
        $post = implode($post);

        return [
            'uuid' => Str::uuid(),
            'title' => $title,
            'slug' => Str::slug($title, '-'),
            'content' => $post,
            'metadata' => [
                'image' => Str::uuid(),
                'author' => $this->faker->name
            ]
        ];
    }
}
