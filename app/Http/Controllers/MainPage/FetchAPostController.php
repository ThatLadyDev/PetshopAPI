<?php

namespace App\Http\Controllers\MainPage;

use App\Actions\MainPage\FetchAPostAction;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class FetchAPostController extends Controller
{
    /**
     * @OA\Get(
     ** path="/api/v1/main/blog/{uuid}",
     *   tags={"MainPage"},
     *   summary="Fetch A Single Post",
     *   operationId="singlePost",
     *
     *   @OA\Response(response=200,description="Success"),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\Response(response=404,description="Page Not found"),
     *   @OA\Response(response=422,description="Unprocessable Entity")
     *),
     **/
    public function __invoke(string $uuid, FetchAPostAction $fetchAPostAction): JsonResponse
    {
        try {
            $post = $fetchAPostAction->execute($uuid);

            return new JsonResponse([
                'success' => 1,
                'error' => null,
                'data' => [
                    'post' => $post
                ],
                'errors' => [],
                'extra' => []
            ], 200);
        } catch (Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                return new JsonResponse([
                    'success' => 0,
                    'data' => [],
                    'error' => 'Post not found',
                    'errors' => [],
                    'extra' => []
                ], 422);
            }

            return new JsonResponse(['success' => 0, 'error' => $e->getMessage()], 500);
        }
    }
}
