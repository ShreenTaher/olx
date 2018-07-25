<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'cat_id');
    }
    public function images()
    {
        return $this->hasMany(Image::class, 'prod_id');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'prod_id');
    }
}
