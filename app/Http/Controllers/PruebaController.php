<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



// Esta es otra forma de crear un controller , con el  __invoke , implementado esta forma ya no tendremos 
// que poner en la url(routes/web) esto @nombreDelMetodo .

//Tambien podemos crear arreglos dentro de estos

class PruebaController extends Controller
{
    public function __invoke()
    {

      $recetas = ['Receta pizza' , 'Receta hamburguesa' , 'Receta tacos'];

      $categorias = ['comida mexa','comida argentina', 'postres'];


//    En este caso podemos ver que aqui es donde llamamos a la vista , NOO desde las urls(rutas).
// Y ponemos que retorne "recetas.index" ya que el index esta dentro de una carpeta llamada recetas.
        return view('recetas.prueba') 
                                      //llave    valor
                               ->with('recetas', $recetas) 
                               ->with('categorias' , $categorias) ; 
}  //La forma en que vas a pasar ese arreglo a la vista , para mostrar los elementos del arreglo es con la sintaxis del "with"
// y al with le tenemos que poner una valor para hacer referencia a la variable llamada LLAVE(tipo string), y la variable como tal.




//    return view('recetas.index' , compact('recetas' , 'categorias')) ;  
//Esta es otra forma de hacer exactamente lo mismo que hicimos anteriormente, usamos la funcion "compact" y en los 
// Parentesis ponemos basicamente en tipo string el nombre de la variable que quieres pasarle y asi le pasarias 
//automaticamente llave y valor al mismo tiempo
}

//__________________________________________________________________________________________




// Esta es la forma clasica de crear un controller (Agregandole un nombre al metodo, en este caso se llama 'hola')
/* __________________________________________________________
class PruebaController extends Controller
{
    public function hola()
    {
        return view('nosotros');
    }
}      
 */

