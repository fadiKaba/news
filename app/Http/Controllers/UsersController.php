<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Admincat;

class UsersController extends Controller
{   

    public function index(){
        $users = User::where('is_admin', 1)->with('category')->get();
        $usersClient = User::where('is_admin', 0)->get();
        return view('admin.admin-users')->with(compact('users', 'usersClient'));
    }

    public function getUsersJson(){
        $users = User::where('is_admin', 1)->with('category')->get();
        return $users;
    }
    
    public function getUsersClientJson(){
        $users = User::where('is_admin', 0)->get();
        return $users;
    }

    public function getCategories(){
      $categories = Admincat::all();
      return $categories;
    }

    public function addCategory($userId, $catId){
        $user = User::findOrFail($userId);

        foreach($user->category as $cat){
            if($cat->id == $catId){
                $user->category()->detach($catId);
                return 'detach';
            }
        }

        $user->category()->attach($catId);
        return 'attatch';
    }

    public function store(Request $request, $userId){
        $user = User::findOrFail($userId);

        $request->validate([
            'name' => 'nullable|min:3',
            'email' => 'nullable|email',
            'role' => 'nullable|integer'
        ]);
        
        $user->update([
            'name' => $request->name == '' ? $user->name : $request->name,
            'email' => $request->email == '' ? $user->email : $request->email,
            'is_admin' => $request->role == '' ? $user->is_admin : $request->role,
        ]);

        if($request->role == 0){
           foreach($user->category as $cat){
              $user->category()->detach($cat->id);
           } 
            
        }
        return 'saved';
    }
   
}
