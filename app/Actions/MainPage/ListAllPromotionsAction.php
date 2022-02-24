<?php

namespace App\Actions\MainPage;

use App\Models\Promotion;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListAllPromotionsAction
{
    public function execute() : LengthAwarePaginator
    {
        return Promotion::orderBy('id', 'desc')->paginate(10);
    }
}
