<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Admincat;
use App\Continent;
use File;
use Auth;
use Image;


class PostsController extends Controller
{   
    public function index($adminCatId){
        $category = Admincat::findOrFail($adminCatId);
        $posts = Post::where('admincat_id', $adminCatId)->get();
        $user = 'false';
        $authcat = 'false';
        if(Auth::check() && Auth::user()->is_admin == 1 & count(Auth::user()->category) > 0){
            for($i = 0; $i < count(Auth::user()->category); $i++){
                if(Auth::user()->category[$i]->id == $adminCatId){
                    $authcat = 'true';
                }
            }
        }
        if(Auth::check()){
            $user = Auth::user();
        }
        return view('category')->with(compact('posts', 'authcat', 'user', 'category'));
    }

    public function show($postId){
        $post = Post::where('id', $postId)->with('admincat')->with('user')->first();
        return view('single-post')->with(compact('post'));
    }

    public function update(Request $request, $postId, $adminCatId){
          
        $catAllowed = false;
          if(count(Auth::user()->category) != 0){
              for($i = 0; $i < count(Auth::user()->category); $i++){
                  if(Auth::user()->category[$i]->id == $adminCatId){
                      $catAllowed = true;
                  }
              }
          }

        if(count(Auth::user()->category) == 0 || $catAllowed ){
            $post = Post::findOrFail($postId);
            $src = '';
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

                $src = $imgName;
            }

            $post->update([
                'admincat_id' => $request->admincat_id,
                'title' => $request->title,
                'body' => $request->body,
                'title_ar' => $request->title_ar,
                'body_ar' => $request->body_ar,           
            ]);
            
            if($src != ''){
                return $src;
            }else{
            return 'saved';  
            } 
        }       
    }

    public function getSpecials($categoryId){
        $cats = ['main','world','arts', 'sport', 'business', 'Health', 'food', 'travel', 'magazine', 'books', 'style', 'opinion'];
        if($categoryId == 2){
           $specials = Continent::all();
           return $specials;
        }
    }
}
