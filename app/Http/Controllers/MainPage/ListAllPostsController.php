<?php

namespace App\Http\Controllers\MainPage;

use App\Actions\MainPage\ListAllPostsAction;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;

class ListAllPostsController extends Controller
{
    /**
     * @OA\Get(
     ** path="/api/v1/main/blog",
     *   tags={"MainPage"},
     *   summary="Fetch All Created Posts",
     *   operationId="allPosts",
     *
     *   @OA\Response(response=200,description="Success"),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\Response(response=404,description="Page Not found"),
     *   @OA\Response(response=422,description="Unprocessable Entity")
     *),
     **/
    public function __invoke(ListAllPostsAction $listAllPostsAction): JsonResponse
    {
        try {
            $posts = $listAllPostsAction->execute();

            return new JsonResponse([
                'success' => 1,
                'error' => null,
                'data' => [
                    'posts' => $posts
                ],
                'errors' => [],
                'extra' => []
            ], 200);
        } catch (Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
