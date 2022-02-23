<?php

namespace App\Actions\MainPage;

use App\Models\Post;

class ListAllPostsAction
{
    public function execute()
    {
        return Post::orderBy('id', 'desc')->paginate(10);
    }
}
