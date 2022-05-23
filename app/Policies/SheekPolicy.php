<?php

namespace App\Policies;

use App\Models\Sheek;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SheekPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sheek  $sheek
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Sheek $sheek)
    {
        //
        return $user->id == $sheek->admin_id
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        //
        return auth('admin')->check()
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sheek  $sheek
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Sheek $sheek)
    {
        //
        return $user->id == $sheek->admin_id
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sheek  $sheek
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Sheek $sheek)
    {
        //
        return $user->id == $sheek->admin_id
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sheek  $sheek
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Sheek $sheek)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sheek  $sheek
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Sheek $sheek)
    {
        //
    }
}
