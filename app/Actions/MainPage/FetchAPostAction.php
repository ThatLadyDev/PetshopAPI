<?php

namespace App\Actions\MainPage;

use App\Models\Post;

class FetchAPostAction
{
    public function execute(string $uuid) : Post
    {
        return Post::where('uuid', $uuid)->firstOrFail();
    }
}
