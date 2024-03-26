<?php

namespace App\Providers;

use App\Models\CategoriaReceta;
use Illuminate\Support\ServiceProvider;
use View;   //Aqui importamos la variable principal para nuesra herramienta, ESTO LO TENEMOS QUE PONER PARA NUESTRO MENU SUPERIOR



class CategoriasProvider extends ServiceProvider
{
    /**
     * Register services.
     * @return void
     */
    public function register()         //En register vamos a colocar las dependencias  que se van a ejecutar al configurar nuestro proyecto
    {                                 //Por ejemplo si estamos creando algo totalmente separado de laravel lo mejor es colocarlo aqui en register
        //No se usa muy seguido        Se ejecuta antes de que la aplicacion laravel este lista
    }




    /**
     * Bootstrap services.
     * @return void
     *///Aqui si vamos a colocar las cosas relacionadas con laravel y se ejecuta cuando la aplicacion esta lista
     //Aqui vamos a colocar nuestra herramienta para el MENU DE RECETAS SUPERIOR            
    public function boot()                     
    {                                         
        
        View::composer('*', function($view) {

         //Aqui obtenemos todas las recetas para pasarlas a la variable del provider, por medio de variable 'categorias'
         $categorias = CategoriaReceta::all();

           $view ->with('categorias' , $categorias);
        });            //Variable 

    }
}
