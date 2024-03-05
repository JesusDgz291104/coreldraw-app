<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class BlogController extends Controller
{

    public function index(): View
    {
        $posts = Post::paginate(2); //::where('posted', 'yes')
        return view("web.blog.index", compact('posts'));
    }


    public function show(Post $post): string|View
    {
        if(Cache::has('post_show_'.$post->id)){
            return Cache::get('post_show_'.$post->id);
        }else{
            $cacheView = view('web.blog.show', compact('post'))->render();
            Cache::put('post_show_'.$post->id,$cacheView);
            return $cacheView;
        }

       // return view('web.blog.show', compact('post'));
    }
}
