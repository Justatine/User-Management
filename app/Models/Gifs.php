<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gifs extends Model
{
    public $timestamps = true;  
    protected $fillable = [
        'userid',
        'title',
        'image',
        'download_count'
    ];
    public function comments()
    {
        return $this->hasMany(Comment::class, 'gif_id');
    }
}
