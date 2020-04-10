<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Admincat;

class UsersController extends Controller
{   

    public function index(){
        $users = User::with('category')->get();
        return view('admin.admin-users')->with(compact('users'));
    }

    public function getCategories(){
      $categories = Admincat::all();
      return $categories;
    }

    public function addCategory($userId, $catId){

        $user = User::findOrFail($userId);
        $categories = Admincat::all();

        foreach($user->category as $cat){
            if($cat->id == $catId){
                $user->category()->detach($catId);
                return 'detach';
            }else{
                 $user->category()->attach($catId);
                 return 'attach';
            }
        }  
        
        
        if(count($user->category) === 0){
            $user->category()->attach($catId);
            return 'attach';
        }
    }
   
}
