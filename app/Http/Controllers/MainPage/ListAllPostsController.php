<?php

namespace App\Http\Controllers\MainPage;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Actions\MainPage\ListAllPostsAction;

class ListAllPostsController extends Controller
{
    public function __invoke(ListAllPostsAction $listAllPostsAction) : JsonResponse
    {
        try {
            $posts = $listAllPostsAction->execute();

            return new JsonResponse([
                'success' => 1,
                'error'   => null,
                'data'    => [
                    'posts' => $posts
                ],
                'errors'  => [],
                'extra'   => []
            ], 200);
        }
        catch (Exception $e){
            return new JsonResponse([
                'success' => 0,
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
