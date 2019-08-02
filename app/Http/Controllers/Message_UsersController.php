<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Message_Users;

class Message_UsersController extends Controller
{
    public function check($recieverId){
        $senderId = Auth::user()->id;

        $data = [
            'sender_id' => $senderId,
            'reciever_id' => $recieverId
        ];
        $data2 = [
            'sender_id' => $recieverId,
            'reciever_id' => $senderId
        ];

        $checkExist = Message_Users::where('sender_id', $senderId)->where('reciever_id', $recieverId)->first();

        if(!$checkExist){
            $createConvo = Message_Users::create($data);
            $createConvo2 = Message_Users::create($data2);
            return $createConvo->id;
        }else{
            return $checkExist->id;
        }
    }
}
