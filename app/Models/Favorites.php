<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    public $timestamps = true;  
    protected $fillable = ['user_id', 'gif_id'];

    public function gif()
    {
        return $this->belongsTo(Gifs::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
