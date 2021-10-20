<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class User extends Model implements Authenticatable
{
    use BasicAuthenticatable;

    protected $fillable = ['email', 'password', 'avatar'];

    public function messages()
    {
        return $this->hasMany(Message::class)->latest();
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }

    public function isFollowing(User $user): bool
    {
            return $this->following()->where('followed_id', $user->id)->exists();
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return '';
    }
}
