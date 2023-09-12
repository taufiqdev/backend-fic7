<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;
use Illuminate\Auth\Access\Response;


class CategoryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(?User $user):bool  {
        //dd($user);
        return true;
        //return false;
        //return Response::allow();
        /* if ($user->role=='admin') {
            return true;
        }
        return false; */
    }

    public function view(User $user, Catogory $category):bool  {
        return true;
        //return false;
        //return Response::allow();
        /* if ($user->role=='admin') {
            return true;
        }
        return false; */
    }

    public function create(User $user):bool  {
        //dd($user);
        if ($user->role=='admin') {
            return true;
        }
        return false;
        //return $user->hasRole('admin');
    }
    public function update(User $user, Category $category):bool  {
        if ($user->role=='admin') {
            return true;
        }
        return false;
    }
    public function delete(User $user, Category $category):bool  {
        if ($user->role=='admin') {
            return true;
        }
        return false;
    }
    public function restore(User $user, Category $category):bool  {
         
        return false;
    }
    public function forceDelete(User $user, Category $category):bool  {
        
        return false;
    }


}
