<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Messages;

class MessagesController extends Controller
{
    public function store(Request $request){
        
        $data = [
            'sender_id' => Auth::user()->id,
            'reciever_id' => $request->reciever_id,
            'message' => $request->message
        ];

        //return $data;
        Messages::create($data);

        return redirect()->back();

    }

    public function load($sender=null){
        $sender = 2;
        $reciever = 1;

        $data = Messages::where('sender_id', $sender)
        ->where('reciever_id', $reciever)
        ->orWhere('sender_id', $reciever)
        ->orWhere('reciever_id', $sender)
        ->get();
        
        return $data;
    }
}
