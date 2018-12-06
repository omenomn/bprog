<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use Auth;

class UsersController extends Controller
{
    public function list()
    {
    	$users = User::where('id', '<>', Auth::user()->id)->get();

    	return new UserCollection($users);
    }
}
