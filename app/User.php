<?php

namespace App;

use App\Models\Contact;
use App\Models\Favourite;
use App\Models\Message;
use App\Models\PhoneData;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone', 'address', 'active_code', 'tokens', 'role', 'facebook', 'twitter'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function contacts()
    {
        return $this->hasMany(Contact::class, 'user_id');
    }
    public function favourites()
    {
        return $this->hasMany(Favourite::class, 'user_id');
    }
    public function phonedatas()
    {
        return $this->hasMany(PhoneData::class, 'user_id');
    }
    public function product()
    {
        return $this->hasMany(Product::class, 'prod_id');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'user_id');
    }
    public function messages($user, $loggedUser)
    {
        return Message::where([['sender_id', $loggedUser->id], ['receiver_id', $user->id]])
            ->orWhere(function ($query) use ($user, $loggedUser) {
                return $query->where([['sender_id', $user->id], ['receiver_id', $loggedUser->id]]);
            })->get();
    }
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
}
