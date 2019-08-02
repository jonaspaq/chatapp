<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $foreignKey = 'message_user_id';

    protected $fillable = [
        'message_users_id','message'
    ];
}
