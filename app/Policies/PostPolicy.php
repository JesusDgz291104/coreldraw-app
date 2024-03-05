<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    // /**
    //  * Determine whether the user can view any models.
    //  */
    // public function viewAny(User $user): bool
    // {
    //     //
    // }

    // public function before(User $user, string $ability): bool|null
    // {

    //     if ($user->isAdmin()) {
    //         return true;
    //     }
    //     return false;
    // }

    /**
     * Determine whether the user can view the model.
     */
    public function index(/*User $user, Post $post*/): bool
    {
        return true;
    }

    public function view(User $user, Post $post): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->id > 0;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id == $post->user_id;
    }
    // public function update(User $user, Post $post): Response
    // {
    //     return $user->id == $post->user_id ?  Response::allow() : Response::deny('No ha sido encontrado') ;
    // }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id == $post->user_id;
    }

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore(User $user, Post $post): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Post $post): bool
    // {
    //     //
    // }
}
