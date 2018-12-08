<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Messages\StoreRequest;
use App\Models\Message;
use Auth;
use App\Http\Resources\MessageCollection;

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

    public function list($interlocutor) 
    {
        $recipient = Auth::user();
        $messages = Message::where('recipient_id', $recipient->id)
            ->where('sender_id', $interlocutor->id)
            ->orWhere('recipient_id', $interlocutor->id)
            ->where('sender_id', $recipient->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return new MessageCollection($messages);
    }
}
