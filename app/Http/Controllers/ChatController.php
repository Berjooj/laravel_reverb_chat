<?php

namespace App\Http\Controllers;

use App\Events\MessageReceivedEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function rooms (Request $request) {
        return ChatRoom::all();
    }

    public function messages (Request $request, $roomId) {
        return ChatMessage::where('chat_rooms_id', $roomId)
            ->with(['user', 'room'])
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function newMessage (Request $request, $roomId) {
        $newMessage = new ChatMessage([
            'user_id' => Auth::user()->id,
            'chat_rooms_id'=> $roomId,
            'message' => $request->message,
        ]);

        $newMessage->save();

        MessageReceivedEvent::dispatch($newMessage);
        return $newMessage;
    }
}
