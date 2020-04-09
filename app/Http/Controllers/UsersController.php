<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{   

    public function index(){
        $users = User::with('category')->get();
        return view('admin.admin-users')->with(compact('users'));
    }
    
}
