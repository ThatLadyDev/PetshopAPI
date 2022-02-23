<?php

namespace App\Http\Controllers\OrderStatus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderStatus;
use Illuminate\Support\Str;

class CreateController extends Controller
{
    public function __invoke(Request $request) : void
    {
        OrderStatus::create([
            "uuid"  => Str::uuid(),
            "title" => $request->title,
        ]);
    }
}
