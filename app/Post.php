<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Admincat;
use App\User;

class Post extends Model
{
    protected $fillable = ['title', 'title_ar', 'body', 'body_ar', 'src', 'admincat_id'];

    public function admincat(){
        return $this->belongsTo(Admincat::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
