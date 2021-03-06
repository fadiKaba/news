<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Admincat;
use Hash;
use Validator;

class UsersController extends Controller
{   

    public function index(){
        $users = User::where('is_admin', 1)->with('category')->get();
        return view('admin.admin-users')->with(compact('users'));
    }

    public function getUsersJson(){
        $users = User::where('is_admin', 1)->with('category')->get();
        return $users;
    }
    
    public function getUsersClientJson(){
        // $users = User::where('is_admin', 0)->get();
        $users= User::where('is_admin', 0)->paginate(15);
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

    public function store(Request $request){

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->role,
        ]);

       return 'saved';
    }

    public function update(Request $request, $userId){
        $user = User::findOrFail($userId);

        $request->validate([
            'name' => 'nullable|min:3',
            'email' => 'nullable|unique:users|email',
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

    public function destroy($userId){
        $user = User::findOrFail($userId);
        if($user->is_admin == 1){
            foreach($user->category as $cat){
                $user->category()->detach($cat->id);
             } 
        }
        $user->delete();
        return 'deleted';
    }

    public function search($val){

        if($val != ''){
           $data = ['value' => $val];

            Validator::make($data, [
                'value' => ['required','min:3']
            ])->validate();

            $va = $data['value'];

            $result = User::where('email', 'Like', "%$va%")->get();
            return $result; 
        }
        
    }
   
}
