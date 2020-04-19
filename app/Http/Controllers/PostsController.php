<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Admincat;
use App\Continent;
use App\Artelement;
use App\Sportelement;
use App\Businesselement;
use App\Healthelement;
use App\Foodelement;
use App\Bookelement;
use App\Stylelement;
use App\Opinonelement;
use App\Sienceelement;
use File;
use Auth;
use Image;


class PostsController extends Controller
{   
    public function index($adminCatId){
        $category = Admincat::findOrFail($adminCatId);
        $posts = Post::where('admincat_id', $adminCatId)->with('user')->orderBy('created_at','desc')->paginate(9);
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
    
    public function newPost(Request $request){
        $request->validate([
            'title' => 'required|max:500',
            'body' => 'required',
            'title_ar' => 'required|max:500',
            'body_ar' => 'required',
            'special' => 'required',
            'img' => 'required|image',
        ]);

        $img = $request->file('img');
        $imgName = 'post' . Auth::id() . time() . '.' . $img->extension();
        $destination = 'images/single-post-photos';
        if(!File::isDirectory($destination)){
            File::makeDirectory($destination);
        }
        $imgM = Image::make($img->path());
        $imgM->orientate()->fit(1200, 800, function($constrain){
            $constrain->aspectRatio();
        })->save($destination.'/'. $imgName);
        
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'title_ar' => $request->title_ar,
            'body_ar' => $request->body_ar,
            'admincat_id' => $request->category,
            'special' => $request->special,
            'src' => $imgName,
            'user_id' => Auth::id(),
        ]);
      
        return $post;
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
      //  $cats = ['main','world','arts', 'sports', 'business', 'Health', 'food', 'travel', 'magazine', 'books', 'style', 'opinion'];
        if($categoryId == 2){
           $specials = Continent::all();
           return $specials;
        }else if($categoryId == 3){
            $specials = Artelement::all();
            return $specials;
         }else if($categoryId == 4){
            $specials = Sportelement::all();
            return $specials;
         }
         else if($categoryId == 5){
            $specials = Businesselement::all();
            return $specials;
         }
         else if($categoryId == 6){
            $specials = Healthelement::all();
            return $specials;
         }
         else if($categoryId == 7){
            $specials = Foodelement::all();
            return $specials;
         }
         else if($categoryId == 10){
            $specials = Bookelement::all();
            return $specials;
         }
         else if($categoryId == 11){
            $specials = Stylelement::all();
            return $specials;
         }
         else if($categoryId == 12){
            $specials = Opinonelement::all();
            return $specials;
         }
         else if($categoryId == 13){
            $specials = Sienceelement::all();
            return $specials;
         }
    }

    public function getRandomPosts($categoryId){
        
          $post1 = Post::where('admincat_id', $categoryId)->where('special', 1)->first();
          $post2 = Post::where('admincat_id', $categoryId)->where('special', 2)->first();
          $post3 = Post::where('admincat_id', $categoryId)->where('special', 3)->first();
          $post4 = Post::where('admincat_id', $categoryId)->where('special', 4)->first();
          $post5 = Post::where('admincat_id', $categoryId)->where('special', 5)->first();

          return json_encode([$post1, $post2, $post3, $post4, $post5]);

    }

    public function latest($categoryId, $special){
        if($special == 'no'){
           $posts = Post::where('admincat_id', $categoryId)->with('user')->orderBy('created_at', 'desc')->paginate(8);
           return $posts;
        }
    }

}
