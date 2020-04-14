<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Admincat extends Model
{
    public function admin(){
        return $this->belongsToMany(User::class);
    }

    public function fourth(){
        return $this->hasMnay(Fourthbarelement::class);
    }
}
