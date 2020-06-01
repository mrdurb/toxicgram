<?php

namespace App\Http\Controllers;

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
     * @return JsonResponse
     */
    public function getUsers(User $user)
    {
        $userChats = $user->chats;
        $users[] = $user;

        foreach ($userChats as $userChat) {
            $users = array_merge($users, $userChat->usersM->toArray());
        }

//        $users = array_unique($users);

        foreach ($users as $key => $item) {
            if ($item['id'] == Auth::user()->id) {
                unset($users[$key]);
            }
        }

        return response()->json($users);
    }
}
