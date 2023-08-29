<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;

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
        return true;
    }

    public function view(User $user, Catogory $category):bool  {
        return true;
    }

    public function create(User $user):bool  {
        if ($user->role=='admin') {
            return true;
        }
        return false;
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
