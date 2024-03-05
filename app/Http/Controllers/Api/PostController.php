<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{

    public function all(): JsonResponse
    {

        // 1 - comprobar cache
        // 2 - Cache existe, devolver cache
        // 3 - Cache no existe, consulta BD - cache y retornar

        // if(Cache::has('post_all')){
        //     // existe
        //     return response()->json(Cache::get('post_all'));
        // }else{
        //     // no existe
        //     $posts = Post::all();
        //     Cache::put('post_all',$posts);
        //     return response()->json($posts);
        // }
        return response()->json(Cache::remember('post_all', now()->addMinutes(10), function () {
            return Post::all();
        }));
        // return Cache::remember('post_all5', now()->addMinutes(10), function () {
        //     return response()->json(Post::where('id', '<', 1000)->get());
        // });
    }
    public function index(): JsonResponse
    {
        return response()->json(Post::paginate(10));
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return response()->json(Post::create($request->validated()));
    }

    public function show(Post $post): JsonResponse
    {
        return response()->json($post);
    }

    public function update(PutRequest $request, Post $post): JsonResponse
    {
        $post->update($request->validated());
        return response()->json($post);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();
        return response()->json("ok");
    }
}
