<?php

namespace App\Actions\MainPage;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListAllPostsAction
{
    public function execute() : LengthAwarePaginator
    {
        return Post::orderBy('id', 'desc')->paginate(10);
    }
}
