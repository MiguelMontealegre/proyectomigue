<?php

namespace App\Policies;

use App\Models\Perfil;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PerfilPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //Este metodo prohibe ver todo , suele usarse para crear una zona premium de el proyecto
    }





    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Auth\Access\Response|bool
     *///este metodo nos permite bloquear ciertas vistas segun nuestra eleccion

    public function view(User $user, Perfil $perfil)
    {
        
        //Bloqueando la vista de editar perfil para usuarios no registrados
        return $user->id === $perfil->user_id;   //Recordar que para bloquear una vista tambien tenemos que ir a el PerfilController y poner en el metodo que queramos bloquear la vista la verificacion del policy poniendole 'view' , es decir  $this->authorize('view' , $perfil);


    }






    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Perfil $perfil)
    {
        //Revisa si el usuario autenticado es el mismo que desea actualizar el perfil , Esto tiene un detalle y es que verifica la autencicidad en el momento en que se este actualizando , por lo cual no bloquearia las vistas ... y para bloquear las vistas precisamente nos sirve el metodo "view"
        return $user->id === $perfil->user_id;
    }







    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Perfil $perfil)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Perfil $perfil)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Perfil $perfil)
    {
        //
    }
}
