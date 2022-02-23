<?php

namespace App\Http\Controllers\MainPage;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Actions\MainPage\FetchAPostAction;
use Exception;

class FetchAPostController extends Controller
{
    public function __invoke($uuid, FetchAPostAction $fetchAPostAction) : JsonResponse
    {
        try {
            $post = $fetchAPostAction->execute($uuid);

            return new JsonResponse([
                'success' => 1,
                'error'   => null,
                'data'    => [
                    'post' => $post
                ],
                'errors'  => [],
                'extra'   => []
            ], 200);
        }
        catch (Exception $e){
            if ($e instanceof ModelNotFoundException ){
                return new JsonResponse([
                    'success' => 0,
                    'data'    => [],
                    'error'   => 'Post not found',
                    'errors'  => [],
                    'extra'   => []
                ], 422);
            }

            return new JsonResponse(['success' => 0, 'error' => $e->getMessage()], 500);
        }
    }
}
