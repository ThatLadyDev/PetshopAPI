<?php

namespace App\Http\Controllers\MainPage;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Actions\MainPage\ListAllPromotionsAction;

class ListAllPromotionsController extends Controller
{
    public function __invoke(ListAllPromotionsAction $listAllPromotionsAction)
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
