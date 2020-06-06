<?php


namespace App\Repositories;


use App\Models\Chat;

class ChatRepository
{
    public function findById($id)
    {
        return Chat::where('id', $id)->first();
    }

    public function findOrCreate($request)
    {
        $chat = Chat::where('users', $request['users'])->first();
        if ($chat) {
            return [
                'chat' => $chat,
                'new' => false,
            ];
        } else {
            $chat = Chat::create(
                [
                    'users' => $request['users'],
                    'name' => $request['name'],
                    'active' => 1,
                ]
            );
            return [
                'chat' => $chat,
                'new' => true,
            ];
        }
    }
}
