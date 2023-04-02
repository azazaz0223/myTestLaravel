<?php

namespace App\Policies;

use App\Models\Cate;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CatePolicy
{
    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user) : bool
    {
        if ($user->can('cate-list')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user) : bool
    {
        if ($user->can('cate-show')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user) : bool
    {
        if ($user->can('cate-create')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @return bool
     */
    public function update(User $user) : bool
    {
        if ($user->can('cate-update')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user) : bool
    {
        if ($user->can('cate-delete')) {
            return true;
        } else {
            return false;
        }
    }
}