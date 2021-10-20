<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [ 'channel_id', 'name', 'slug', 'youtube', 'file' ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
