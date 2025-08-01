<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
    'user_id',
    'uploaded_by',
    'filename',
    'path',
    'type',
    'comment',
    'encryption_key',
    'dowloaded'
];

public function user()
{
    return $this->belongsTo(User::class);
}

}
