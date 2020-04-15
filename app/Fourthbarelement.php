<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Admincat;

class Fourthbarelement extends Model
{   
    protected $fillable = ['title', 'title_ar', 'body', 'body_ar', 'src', 'admincat_id'];

    public function admincat(){
        return $this->belongsTo(Admincat::class);
    }
}
