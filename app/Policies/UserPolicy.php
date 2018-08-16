<?php

namespace App\Policies;

use App\User;
use App\Associado;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the associado.
     *
     * @param  \App\User $user
     * @param  \App\Associado $associado
     * @return mixed
     */
    public function view(User $user, Associado $associado)
    {
        if ($user->isGuest()) {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can create associados.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the associado.
     *
     * @param  \App\User $user
     * @param  \App\Associado $associado
     * @return mixed
     */
    public function update(User $user, Associado $associado)
    {
        //
    }

    /**
     * Determine whether the user can delete the associado.
     *
     * @param  \App\User $user
     * @param  \App\Associado $associado
     * @return mixed
     */
    public function delete(User $user, Associado $associado)
    {
        //
    }

    public function procurar(User $user)
    {
        if ($user->isGuest()){
            return true;
        }
        return true;
    }
}
