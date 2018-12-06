<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use Auth;
use DB;

class UsersController extends Controller
{
    public function list()
    {
    	$userId = Auth::user()->id;
    	$users = User::where('id', '<>', $userId)
			->select(
				'id',
				'name',
				DB::raw('(select count(*) from messages where messages.recipient_id=' . $userId . ' and messages.sender_id=users.id and messages.is_read=0) as unread_messages'))
			->get();

    	return new UserCollection($users);
    }
}
