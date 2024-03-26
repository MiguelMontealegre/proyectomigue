<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',             // Estos son valores necesarios que se le pasan al modelo cuando se crean nuevos registros  
        'password',          //por lo tanto tenemos que poner el nuevo campo que se quiera
        'url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    
    // EVENTOS PARA PERFILES

    //Evento que se ejecuta cuando un usuario es creado
    protected static function boot(){

       parent::boot();

       //Asignar perfil una vez se cree el usuario
       static::created(function ($user) {
           $user->perfil()->create();                      //Ya con esto  y tambien gracias a la relacion , automaticamente cuando un usuario se registre, los campos de la migracion de los perfiles se llenaran con la info de ese usuario
       });   //perfil:relacion 1:1 U->P
    }





    // Relacion 1:n  ,de 1 usuario a muchas recetas_________________________________Eloquent
    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }
    //____________________________________________________________________-



    //Relacion 1:1 , de usuario a PERFIL
    public function perfil(){
        return $this->hasOne(perfil::class);
    }


    //Recetas a las que le ha dado me gusta el usuario
    //Como van a ser muchas entonces la relacion sera de muchos a muchos
  public function meGusta(){
      return $this->belongsToMany(Receta::class , 'likes_receta');  //Le decimos que nuestra tabla pivot es 'likes_receta'
  }  



}
