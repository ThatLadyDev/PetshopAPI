<?php

namespace App\Actions\Account;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ListUsersAction
{
    public function execute() : LengthAwarePaginator
    {
        return User::where('is_admin', false)->orderBy('id', 'desc')->paginate(10);
    }
}
