<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
    'sender_id',
    'receiver_id',
    'subject',
    'body',
];
public function sender()
{
    return $this->belongsTo(User::class, 'sender_id');
}


}
