<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Repositories\MessageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ChatRepository;
use App\Models\Message;
use App\Repositories\UserRepository;

class ChatController extends Controller
{
    private $chatRepository;

    private $messageRepository;

    private $userRepository;

    public function __construct(
        ChatRepository $chatRepository,
        MessageRepository $messageRepository,
        UserRepository $userRepository
    )
    {
        $this->chatRepository = $chatRepository;
        $this->messageRepository = $messageRepository;
        $this->userRepository = $userRepository;
    }

    public function store(User $user)
    {
        $users = [$user['id'], Auth::user()->id];
        sort($users);
        $data = $this->chatRepository->findOrCreate([
            'users' => json_encode(['users' => $users]),
            'name' => $user['name'],
        ]);
        $user->chats()->syncWithoutDetaching($data['chat']);
        Auth::user()->chats()->syncWithoutDetaching($data['chat']);

        return response()->json($data);
    }

    public function getMessages(Chat $chat)
    {
        $rawMessages = $chat->messages;

        $messages = [];

        foreach ($rawMessages as $rawMessage) {
            $messages[] = [
                'user' => $this->userRepository->findNameById($rawMessage->user_id),
                'content' => $rawMessage->content,
            ];
        }

        return response()->json($messages);
    }
}
