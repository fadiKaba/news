<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fourthbarelement;
use App\Admincat;
use File;
use Auth;
use Image;

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
        ]);

        if($request->file('img') != ''){
             
             $request->validate([
                 'img' => 'image'
             ]);

             if(File::exists('images/single-post-photos/'.$post->src)){
                 File::delete('images/single-post-photos/'.$post->src);
             }

             $img = $request->file('img');
             $imgName = 'post' . Auth::id() . time() . '.' . $img->extension();
             $destination = 'images/single-post-photos';
             if(!File::isDirectory($destination)){
                 File::makeDirectory($destination);
             }
             $imgM = Image::make($img->path());
             $imgM->orientate()->fit(1200, 1000, function($constrain){
                  $constrain->aspectRatio();
             })->save($destination.'/'. $imgName);

             $post->update([
                 'src' => $imgName,
             ]);
        }

        $post->update([
            'admincat_id' => $request->admincat_id,
            'title' => $request->title,
            'body' => $request->body,
            'title_ar' => $request->title_ar,
            'body_ar' => $request->body_ar,           
        ]);
        
        return $post;

    }
}
