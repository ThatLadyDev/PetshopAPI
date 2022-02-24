<?php

namespace App\Actions\Account;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Exception;

class ListUsersAction
{
    public function execute() : LengthAwarePaginator
    {
        if (Auth::user()->is_admin !== true){
            throw new Exception('Unauthorized access');
        }
        return User::where('is_admin', false)->orderBy('id', 'desc')->paginate(10);
    }
}
