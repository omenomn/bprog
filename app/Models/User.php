<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'online',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function getAllMessagesAttribute() 
    {
        return $this->sentMessages->merge($this->receivedMessages)->sortBy('id')->values();
    }

    public function getIsOnlineAttribute()
    {
        $now = Carbon::now()->timestamp;

        if (!$this->online) {
            return $this->online;
        }

        $lastOnline = Carbon::parse($this->online)->timestamp;

        return ($now - $lastOnline > 5) ? false : true;
    }

    public function scopeForSidebar($query, $userId)
    {
        return $query->where('id', '<>', $userId)
            ->select(
                'id',
                'name',
                'online',
                DB::raw('(select count(*) from messages where messages.recipient_id=' . $userId . ' and messages.sender_id=users.id and messages.is_read=0) as unread_messages'),
                DB::raw('(select max(ms.created_at) from messages as ms where ms.recipient_id=' . $userId . '  and ms.sender_id=users.id) as last_message')
            )->with([
                'sentMessages' => function ($query) use ($userId) {
                    $query->where('recipient_id', $userId);
                },
                'receivedMessages' => function ($query) use ($userId) {
                    $query->where('sender_id', $userId);
                }
            ]);
    }
}
