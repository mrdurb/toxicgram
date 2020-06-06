<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request)
    {
        $users = $this->userRepository->findBySearch($request);

        return response()->json($users);
    }

    /**
     * @param User $user
     * @param Chat $chat
     * @return JsonResponse
     */
    public function getUsers(User $user, Chat $chat)
    {
        $userChats = $user->chats;
        $usersId = [];

        $alreadyExistsUsers = $chat->usersM->pluck('id')->toArray();

        foreach ($userChats as $userChat) {
            $usersId = array_unique(array_merge($usersId, $userChat->usersM->pluck('id')->toArray()));
        }

        $usersId = array_diff($usersId, $alreadyExistsUsers);

        $users = $this->userRepository->findAllById($usersId)->get()->toArray();

        return response()->json($users ?? []);
    }
}
