<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fourthbarelement;
class FourtbarelementsController extends Controller
{
    public function index(){
        $posts = Fourthbarelement::all();
        return $posts;
    }

    public function show($postId){
        $post = Fourthbarelement::where('id', $postId)->with('category')->get();
        return view('single-post')->with(compact('post'));
    }

    public function update(Request $request, $postId){
        $post = Fourthbarelement::findOrFail($postId);
        $request->validate([

        ]);
    }
}
