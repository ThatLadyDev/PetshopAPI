<?php

namespace App\Http\Controllers\MainPage;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Actions\MainPage\ListAllPromotionsAction;

class ListAllPromotionsController extends Controller
{
    /**
     * @OA\Get(
     ** path="/api/v1/main/promotions",
     *   tags={"MainPage"},
     *   summary="Fetch All Promotions",
     *   operationId="allPromotions",
     *
     *   @OA\Response(response=200,description="Success"),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\Response(response=404,description="Page Not found"),
     *   @OA\Response(response=422,description="Unprocessable Entity")
     *),
     **/
    public function __invoke(ListAllPromotionsAction $listAllPromotionsAction) : JsonResponse
    {
        try {
            $promotions = $listAllPromotionsAction->execute();

            return new JsonResponse([
                'success' => 1,
                'error'   => null,
                'data'    => [
                    'promotions' => $promotions
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
