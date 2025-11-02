<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function post() 
    {
        return $this->belongsTo(User::class);
    }
}
