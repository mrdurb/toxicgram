<?php


namespace App\Repositories;


use App\Models\Message;

class MessageRepository
{
    public function findLastMessageByChatId($id)
    {
        return Message::where('chat_id', $id)->orderBy('created_at', 'desc')->first();
    }
}
