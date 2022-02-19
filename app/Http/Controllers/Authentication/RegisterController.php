<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserRegistrationRequest;
use Illuminate\Http\JsonResponse;
use App\Actions\Auth\CreateUserAction;
use Exception;

class RegisterController extends Controller
{
    public function __invoke(UserRegistrationRequest $request, CreateUserAction $createUserAction): JsonResponse
    {
        try{
            $createUserAction->execute($request->all());
            return new JsonResponse(['success' => true, 'message' => 'Account Created Successfully'], 200);
        }
        catch(Exception $e){
            return new JsonResponse(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
