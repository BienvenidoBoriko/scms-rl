<?php

namespace App\Policies;

use App\Post;
use App\User;
use App\rol;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Str;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $rol=rol::find($user->rol_id);
        return (Str::of('admin')->exactly($rol->name) || Str::of('author')->exactly($rol->name));
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        $rol=rol::find($user->rol_id);
        return (Str::of('admin')->exactly($rol->name) || Str::of('author')->exactly($rol->name));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $rol=rol::find($user->rol_id);
        return (Str::of('admin')->exactly($rol->name) || Str::of('author')->exactly($rol->name));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        $rol=rol::find($user->rol_id);
       return Str::of('admin')->exactly($rol->name) || $user->id===$post->author_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function upload(User $user, Post $post)
    {
        $rol=rol::find($user->rol_id);
        return (Str::of('admin')->exactly($rol->name) || Str::of('author')->exactly($rol->name));

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        $rol=rol::find($user->rol_id);
       return Str::of('admin')->exactly($rol->name);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function restore(User $user, Post $post)
    {
        $rol=rol::find($user->rol_id);
       return Str::of('admin')->exactly($rol->name);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function forceDelete(User $user, Post $post)
    {
        $rol=rol::find($user->rol_id);
       return Str::of('admin')->exactly($rol->name);
    }
}
