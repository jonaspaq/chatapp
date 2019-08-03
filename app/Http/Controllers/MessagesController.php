<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message_Users;
use Auth;
use App\Messages;

class MessagesController extends Controller
{
    public function store(Request $request){
        $data = [
            'message_users_id' => $request->convo_id,
            'message' => $request->message
        ];

        $sendMessage = Messages::create($data);

        if($sendMessage){
            return "Message Sent";
        }else{
            return "Error sending message.";
        }
    }

    public function load($reciever, $sender){
        $boxType = "";

        $id1 = Message_Users::where('sender_id', $sender)->where('reciever_id',$reciever)->pluck('id');
        $id2 = Message_Users::where('reciever_id', $sender)->where('sender_id',$reciever)->pluck('id');

        $allMessages = Messages::where('message_users_id', $id1)->orWhere('message_users_id', $id2)->orderBy('id', 'asc')->get();
        
        // foreach($allMessages as $row){
        //     if($id1[0]==$row['message_users_id']){$boxType = "p-2 recieverBox ml-auto";}else{$boxType = "float-left p-2 mb-2 senderBox";}
        //     echo "<div class='p-2 d-flex'>";
        //     echo "<div class='".$boxType."'>";
        //     echo "<p>".$row['message']."</p>";
        //     echo "</div>";
        //     echo "</div>";
        // }
        $tobePassed = [$allMessages, $id1];
        return $tobePassed;
    }

    public function retrieveNew($reciever, $sender, $lastId){
        $id1 = Message_Users::where('sender_id', $sender)->where('reciever_id',$reciever)->pluck('id');
        $id2 = Message_Users::where('reciever_id', $sender)->where('sender_id',$reciever)->pluck('id');

        $allMessages = Messages::where('id','>=',$lastId)->where('message_users_id', $id2)->orderBy('id', 'asc')->get();

        return $allMessages;
    }
}
