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
    	$users = User::forSidebar($userId)->get();

    	return new UserCollection($users);
    }
}
