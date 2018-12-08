<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
use App\Models\Message;
use App\Http\Resources\UserCollection;
use Carbon\Carbon;

class ChatController extends Controller
{
    public function usersWithMessages($interlocutor = null)
    {
        $recipient = Auth::user();
    	$users = User::forSidebar($recipient->id)->get();

        return new UserCollection($users);
    }

    public function onlineUpdate()
    {
    	$user = Auth::user();

    	$user->update([
    		'online' => Carbon::now(),
    	]);

    	return response()->json([
    		'msg' => trans('messages.success'),
    	]);
    }
}
