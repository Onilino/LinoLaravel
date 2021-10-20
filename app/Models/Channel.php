<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\isEmpty;

class Channel extends Model
{
    protected $fillable = [ 'name', 'slug', 'illustration', 'colour' ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
