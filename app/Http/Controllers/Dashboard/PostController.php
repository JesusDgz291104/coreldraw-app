<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = Post::paginate(2); // personaliza la paginacion como quieras
        if (!Gate::allows('index', $posts[0])) {
            abort(403);
        }
        return view('dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::pluck('id', 'title');
        $post = new Post();

        if (!Gate::allows('create', $post)) {
            abort(403);
        }

        return view('dashboard.post.create', compact('categories', 'post'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {

        $post = new Post($request->validated());
        //$post = Post::create($request->all());

        if (!Gate::allows('create', $post)) {
            abort(403);
        }

       // Auth::user()->posts()->save($post);

        return to_route("post.index")->with('status', "Registro actualizado.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {

        // TEST
        // if (Gate::any(['update', 'view'], $post)) {
        //     dd(true);
        // }
        // if (Gate::none(['update', 'view'], $post)) {
        //     dd(true);
        // }

        // if (Auth::user()->can('update', $post)) {
        //     dd(true);
        // }

        // if (Gate::forUser(User::find(2))->allows('update', $post)) {
        //     dd(true);
        // }

        // Gate::allowIf(function (User $user) {
        //     return !$user->isAdmin();
        // });
        // Gate::allowIf(
        //     fn (User $user) =>
        //     $user->isAdmin()
        // );
        // Gate::denyIf(
        //     fn (User $user) =>
        //     !$user->isAdmin()
        // );

       //  Gate::authorize('create', $post);

        // TEST

        // if (!Gate::allows('view', $post)) {
        //     abort(403);
        // }
        return view("dashboard.post.show", compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {

        // if (!Gate::allows('update-post', $post)) {
        //     abort(403);
        // }

        //dd(Gate::inspect('update', $post));

        if (!Gate::allows('update', $post)) {
            abort(403);
        }

        $categories = Category::pluck('id', 'title');
        return view('dashboard.post.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post): RedirectResponse
    {
        if (!Gate::allows('update-post', $post)) {
            abort(403);
        }

        $data = $request->validated();
        if (isset($data["image"])) {
            $data["image"] = $filename = time() . "." . $data["image"]->extension();

            $request->image->move(public_path("image/otro"), $filename);
        }

        $post->update($data);

        return to_route("post.index")->with('status', "Registro actualizado.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        if (!Gate::allows('delete', $post)) {
            abort(403);
        }
        $post->delete();
        return to_route("post.index")->with('status', "Registro eliminado.");
    }
}
