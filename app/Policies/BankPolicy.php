<?php

namespace App\Policies;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BankPolicy
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
        return auth('admin')->check()
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Bank $bank)
    {
        //
        return $user->id == $bank->admin_id
            ?  $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($users)
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
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Bank $bank)
    {
        //
        return $user->id == $bank->admin_id
            ?  $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Bank $bank)
    {
        //
        return $user->id == $bank->admin_id
            ?  $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Bank $bank)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Bank $bank)
    {
        //
    }
}
