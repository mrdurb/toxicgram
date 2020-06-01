<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MessageRepository;

class HomeController extends Controller
{
    private $messageRepository;

    /**
     * Create a new controller instance.
     *
     * @param MessageRepository $messageRepository
     */
    public function __construct(
        MessageRepository $messageRepository
    )
    {
        $this->middleware('auth');

        $this->messageRepository = $messageRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $userChats = Auth::user()->chats()->where('active', true)->get();
        $chats = [];

        foreach ($userChats as $userChat) {
            $chats[] = [
                'id' => $userChat->id,
                'name' => $userChat->name,
                'lastMessage' => $this->messageRepository->findLastMessageByChatId($userChat->id),
            ];
        }

        return view('index', [
            'userChats' => $chats,
        ]);
    }
}
