<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Messages\StoreRequest;
use App\Models\User;
use Auth;

class MessagesController extends Controller
{
    public function store(StoreRequest $request, $interlocutor)
    {
    	$sender = Auth::user();
    	$sender->sentMessages()->create([
    		'message' => $request->message,
    		'recipient_id' => $interlocutor->id,
    	]);
    	
    	return response()->json([
    		'msg' => trans('messages.message_sent')
    	]);
    }
}
