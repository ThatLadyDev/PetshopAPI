<?php

namespace App\Actions\MainPage;

use App\Models\Promotion;

class ListAllPromotionsAction
{
    public function execute()
    {
        return Promotion::orderBy('id', 'desc')->paginate(10);
    }
}
