<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $message = new Message();
        $message->fill($request->all());
        $message->save();

        return response()->json($message);
    }
}
