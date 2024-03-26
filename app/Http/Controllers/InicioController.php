<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoriaReceta;

class InicioController extends Controller
{
    public function index(){


     //Mostrar recetas por cantidad de votos osea likes
     //$votadas = Receta::has('likes' , '>' , valorQueDesee)->get();   Esta seria una forma de hacerlo pero toma valores muy estaticos ,Por ejemplo obtener recetas que tengan mas de 3 likes , o tengan determinada cantidad ,  pero la dejamos comentada ya que puede ser muy util en oros casos  
                //El primer parametro del "has" es el nombre de la relacion que creamos en el model

        $votadas = Receta::withCount('likes')->orderBy('likes_count' , 'desc')->take(5)->get();  //Aqui basicamnete Usuamos la herramienta 'withCount' la cual crea una columna temporal con los datos de algun parametro en este caso le mandamos 'likes' que es la relacion , y despues con el 'orderBy' ordenamos de forma que primero se muestren las que mas cantidad de likes tengan.. y con el take solo obtendriamos las 5 mas votadas



      //Obtener las recetas mas nuevas
        $nuevas = Receta::orderBy('created_at', 'DESC')->limit(10)->get();     // "ASC" -> Ascendente  , "DESC" -> Descendente
      //Esto puede ser abreviado para los mas recientes como:   $nuevas = Receta::latest()->get();
      //O para los mas viejos como:   $nuevas = Receta::oldest()->get();

      //Para no tener tanto trafico visual, podemos referenciar con la funcion:  "limit()" o take() cuantas recetas de las mas nuevas queremos obtener



      // Obtener todas las RECETAS POR CATEGORIA ______________________________________________________________________

      $categorias = CategoriaReceta::all();  //Obtiene todas las categorias


      //Agrupar las recetas por categoria
      $recetas = [];

      foreach($categorias as $categoria){
         $recetas[Str::slug($categoria->nombre)] [] = Receta::where('categoria_id' , $categoria->id)->take(5)->get();      //Va a ser un arreglo de 2 dimensiones y que por Eje:  [Mexicana] => [recetas mexicanas]
      }
      //el Str::slug nos sirve para que los espacios entre palabras se transformen en guiones , y asi evitar errores de backend



      return view('inicio.index' , compact('nuevas' , 'recetas' ,'votadas'));
    }
}
