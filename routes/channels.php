<?php

use App\Models\ChatRoom;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('room.{roomId}', function (User $user, int $roomId) {
    return ChatRoom::findOrFail($roomId)->id;
});

Broadcast::channel('new_user', function (User $user) {
    return true;
});