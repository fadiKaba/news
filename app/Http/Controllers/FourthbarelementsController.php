<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fourthbarelement;
use App\Admincat;
class FourthbarelementsController extends Controller
{
    public function index(){
        $posts = Fourthbarelement::all();
        return $posts;
    }

    public function show($postId){
        $post = Fourthbarelement::where('id', $postId)->with('admincat')->first();
        return view('single-post')->with(compact('post'));
    }

    public function update(Request $request, $postId){
        $post = Fourthbarelement::findOrFail($postId);
        $request->validate([
          'title' => 'required|max:500',
          'body' => 'required',
          'title_ar' => 'required|max:500',
          'body_ar' => 'required',
          'img' => 'required|image',
        ]);

        // if($request->image != ''){
        //     $img = $request->file('image');
        //     $imgName ='pos' . Auth::id() . time() . '.' . $img->extension(); 
        //     $destination = 'posts-images';
        //     if(!File::isDirectory($destination)){
        //         File::makeDirectory($destination, 0777, true, true);   
        //     }
        //     $imgM = Image::make($img->path());
        //     $imgM->orientate()->fit(1200, 700, function($constrain){
        //         $constrain->aspectRatio();
        //     })->save($destination. '/'. $imgName);           
        // }

    }
}
