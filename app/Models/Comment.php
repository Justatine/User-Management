<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['gif_id', 'user_id', 'content'];

    protected $appends = ['user_name', 'can_delete'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gif()
    {
        return $this->belongsTo(Gifs::class);
    }

    public function getUserNameAttribute()
    {
        return $this->user->name;
    }

    public function getCanDeleteAttribute()
    {
        return auth()->check() && 
               (auth()->id() === $this->user_id || auth()->user()->is_admin);
    }
}
