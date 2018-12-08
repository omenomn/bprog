<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;

class Message extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
            'css_class' => (Auth::user()->id == $this->sender_id) ? 'sent' : 'replies',
            'is_read' => $this->is_read,
            'created_at' => ($this->created_at) ? $this->created_at->format('m.d.Y h:i:s') : null,
        ];
    }
}
