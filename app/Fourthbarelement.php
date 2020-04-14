<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Admincat;

class Fourthbarelement extends Model
{
    public function category(){
        return $this->belongsTo(Admincat::class);
    }
}
