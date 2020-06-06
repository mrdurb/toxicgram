<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Repositories\MessageRepository;
use Carbon\Carbon;
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

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * @param Chat $chat
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addUsers(Request $request)
    {
        $chat = $this->chatRepository->findById($request['chat_id']);

        $chat->usersM()->attach($request['user_id']);

        $users = $this->userRepository->findAllById($request['user_id'])->pluck('name')->toArray();

        return response()->json($users);
    }

    public function getStatistic(Chat $chat, User $user)
    {
        $userMessages = $user
            ->messages()
            ->where('chat_id', $chat->id)
            ->orderBy('created_at')
            ->get()
        ;

        return response()->json([
            'first_message' => Carbon::parse($userMessages->first()->created_at ?? null)->format('d.m.Y'),
            'last_message' => Carbon::parse($userMessages->last()->created_at ?? null)->format('d.m.Y'),
            'message_count' => $userMessages->count(),
        ]);
    }
}
