<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
    'user_id',
    'filename',
    'path',
    'comment',
];

public function user()
{
    return $this->belongsTo(User::class);
}

}
