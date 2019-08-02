<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message_Users extends Model
{
    protected $table = 'message_users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'sender_id', 'reciever_id'
    ];
}
