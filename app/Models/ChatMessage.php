<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

	protected $fillable = [
		'user_id',
		'chat_rooms_id',
		'message'
	];

	public function room() {
		return $this->belongsTo(ChatRoom::class);
	}

	public function user() {
		return $this->belongsTo(User::class);
	}
}
