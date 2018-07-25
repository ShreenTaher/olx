<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'prod_id');
    }
}
