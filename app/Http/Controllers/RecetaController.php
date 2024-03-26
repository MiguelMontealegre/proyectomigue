<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Receta;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\If_;
use App\Models\CategoriaReceta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{


//Metodo para proteger la reedirecion y accesos de ls rutas 
public function __construct()
{
$this->middleware('auth' , ['except' => ['show' , 'search'] ]);  // De esta forma estamos habilitando un middleware una vez que se crea una instancia 
                            // de recetaController y por lo tanto estamos protegiendo a los demas metodos
                            // Un "middleware es como: primero se hace una accion, despues otra y despues otra y asi
                            // Y mandandole 'auth' le estamos diciendo que queremos habilitar el middleware de autenticacion.  
                            //Es decir que el usuario primero va a tener que registrarse o iniciar sesion y despues va a poder hacer las demas cosas

//Agregandole ese except le estamos indicando que el metodo show si puede ser publico, ya que queremos que las personas que no esten autenticadas tambien vecan las recetas
}




//__________________________________________________________________________________________________________________________________________
    /*1° Metodo: index
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
    //Mostrar las recetas que crea el usuario... ese parametro de recetas es el que creamos en el modelo: User , en el apartado de las relaciones, (La relacion la llamamos "recetas")
     //Auth::   Otra forma de hacer lo mismo. Recordar cuando hay dd es para guiarnos
     //auth()->user()->recetas->dd();

    //Recetas normales
    // $recetas = auth()->user()->recetas;     //Entonces creamos esta variable ,Y le pasamos las recetas creadas agregando un with a la funcion de "return view"

    

    //Tenemos que defiinir la variable usuario antes de mejorar las recetas incluyendole la paginacion
    $usuario = auth()->user();


    //Recetas con paginacion
    $recetas = Receta::where('user_id' , $usuario->id)-> paginate(3);  //El numero que se pone en "paginate" es el numero de recetas que va a filtrar para mostrar en la vista en cada pagina

    
        return view('recetas.index') ->with('recetas' ,$recetas)
                                     ->with('usuario', $usuario);
    }





    /**_______________________________________________________________________________________________________________________
     * 2°Metodo: CREATE
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // DB::table('categoria_recetas')->get()->pluck('nombre','id')->dd();  //Este llamado nos sirve para guiarnos ya que nos va a permitir consultar la base de datos , nos va a mostrar por medio de la pantalla que tenemos en nuestra base.
                                            //El pluck nos permite como filtrar campos de la base, como en este caso solo necesitamos el nombre y el id , pues los llamamos en el pluck y asi solo nos va a retornar lo que necesitemos.


        /* Obtener categorias..Sin Modelo                                    
        $categorias = DB::table('categoria_recetas')->get()->pluck('nombre','id');  //Aqui practicamente lo que hacemos es Obtener almacenar los valores de nuestro seeder pero filtrando solo el nombre y el id y almacenandoles en la variable: $categorias  (En si obtenemos las categorias pero sin usar el Modelo) */
                
        

        //-------  Obtener categorias CON MODELO -----------
        $categorias = CategoriaReceta::all(['id','nombre']);  //Es mucho mas simple con modelo , solo le pasamos el nombre de el modelo , y los otros parametro que podemos ver en [] , son campos que filtramos , osea lo que pongamos dentro de las llaves es lo que vamos a obtener , esas llaves son como un 'pluck'.




        return view('recetas.create')->with('categorias', $categorias); //Y aqui mostramos la vista de create mandandole la variable $categorias
    }

    

    /**____________________________________________________________________________________________________________________________
     * 3°Metodo: Store
     * Store a newly created resource in storage ... Metodo que vamos a ajecutar cuando necesitemos almacenar cosas
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     
    public function store(Request $request)   //En esta linea ese "request" es lo que se envia a ese "store" (titulo de la receta y el token)
    {

        $data = request()->validate([    //El valor de "request va a ser igual $data , osea vamos a asignar los valores de request a la variable data
        'titulo' => 'required|min:6',          // Y le pasamos "validate"(que es un metodo que existe en el request) , y despues le pasamos un arreglo con lo que se va a validar en este caso "required" pa que sea obligatorio (puedes aplicar variaciones de acuerdo a las reglas de validacion como maxima cantidad de caracteres ,minima etc)
        'categoria' => 'required',
        'preparacion' => 'required',
        'ingredientes' => 'required',
        // 'imagen' => 'image' //Aqui estamos validando que el usuario ingrese una imagen por lo cual si agregamos "image" laravel revisara que sea una imagen ,sirve para todos los formatos de imagen , y tambien con el size laravel revisara que el tamaño maximo de la imagen sea de 1000
    ]);    
    //En estos nuevo campos nuevos estamos validando la parte en la que el usuario esta creado una nueva receta con todas estas caracteristicas y tiene que poner algo en cada uno de estos campos 


    //3° paso...creamos una variable donde vamos a obtener la ruta de la imagen...  esta funcion debe estar ubicada despues de la validacion 
    // $ruta_imagen = ( $request['imagen']->store('upload-recetas', 'public') );
    

//5°paso opcional , Resize de la imagen... Vamos a crear una variable la cual va a contener la imagen original , la va a hacer mas pequeña y la va a guardar en el servidor , pero recordar que la ruta de imagen sigue siendo la misma
//Ese atributo "Image" es el de el editor(intervention image) y lo tenemos que importar como un facade ... Y en si ahi en esa linea de codigo le estamos diciendo que a la imagen que tnemos en sea ruta le hagamos tales cambios  
//  $img = Image::make( public_path("storage/{$ruta_imagen}"))-> fit(1000, 550);
//  $img->save();  //Y agregandole save le decimos que lo guarde en el servidor



/*ya cuando hallamos validado nuestros campos ahora los vamos a insertar en la base de datos (sin modelos)
        DB::table('recetas')->insert([    // Basicamente aqui insertamos algun registro en la base de datos (coloquialmente le estamos diciendo que guarde en nuestra base datos llamada "recetas" algun registro en este caso el titulo de la receta)
            'titulo'=> $data['titulo'],
            'preparacion'=> $data['preparacion'],
            'ingredientes'=> $data['ingredientes'],
            'user_id'=> Auth::user()->id,  //Con este helper nos permitimos saber que usuario esta autenticado , osea que id de usuario creo esa receta , la priimera vez que se cree hay que importar la clase 
            'categoria_id'=>$data['categoria'],  //Y con esta sintaxis en la base de datos nos va a aparecer el id de la categoria eligida por el usuario , ejemplo que escogio la c.italiana la cual es la segunda entonces nos va a aparecer el id 2.
            'imagen'=> '$ruta_imagen'
       ]);                                 */


//Almacenar en la base de datos con MODELO   
//Primero ponemos 'auth' para tomar el usuario que este autenticado, depues 'user' para acceder a la info de ese usuario
//Despues con 'recetas' accedemos a sus recetas, ese parametro de recetas sera el mismo que esta definido en el Model: User en la relacion 1:n
   auth()->user()->recetas()->create([

    'titulo'=> $data['titulo'],
    'preparacion'=> $data['preparacion'],
    'ingredientes'=> $data['ingredientes'],
    'categoria_id'=>$data['categoria'],  
    // 'imagen'=>$ruta_imagen  //Las variables van sin COMILLAS !!!
   ]);     




//Para almacenar las imagenes:  1°Paso
// La referencia de la imagen se va a guardar en la base de datos , y la imagen como tal se guardara en el servidor. 
//Con esta funcion vamos a guardarlo en el disco duro del servidor, 2°Paso: ¡recordar que en la vista de create.blade en la etiqueta del "form" tenemos que agregarle enctype="multipart/form-data" como atributo para que el porceso sea exitoso , si no hace esto pailas     
// esa imagen quedara almacenada en  storage/app/public/upload-recetas ... recordar que esto es para guiarnos !    
 //dd( $request['imagen']->store('upload-recetas', 'public') );    //Si trabajamos con AWS, cambiamos public por 'aws'
//              ref del campo     nombre de carpeta en la cual se va a almacenar,esa carpeta va a ser en el disco duro del servidor.





       // dd($request->all() );    //En esta linea ;Esta funcion "dd" es muy similar a un var-dump lo que hace es que envia el token 
        //de identificacion y tambien envia lo que pongamos dentro de el input que en este caso el titulo de la receta.
        // Y de esa forma ya podemos leer lo que hayamos enviado e insertarlo en la base de datos 
        //la funcion "all" nos va a imprimir todo lo que sea parte de ese "request"...Pero solo la vamos a usar como guia 




        //Ya cuando la insertada de los campos de la nueva receta es efectiva lo que hace la pag es redireccionarnos a /recetas pero con el metodo POST .
        //Entonces ahora lo que vamos a hacer es redirecionar de la forma correcta a una ruta que queramos
        return redirect()->action('\App\Http\Controllers\RecetaController@index');
    }




    /**______________________________________________________________________________________________________________________________
     * 3° Metodo: Show
     * Display the specified resource.
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {

      //  $this->authorize('view' , $receta);   Verifica que los usuarios que quieran ver alguna de las recetas este autenticado , en este caso lo dejamos comentado ya que la idea es que puedan ver las recetas sin estar registrados



       //Obtener Si el usuario actual le gusta la receta y esta autenticado (Campo de likes) , en este caso por medio de la variable '$like'
       $like = ( auth()->user() ) ?  auth()->user()->meGusta->contains($receta->id) : false;   //Si no esta autenticado retorna 'false' ... SI esta autenticado pasa a revisar si ya le dio me gusta , y si ya le ha dado like retorna false
                                      //Revisa si ya le dio me gusta__________________


        //Pasa la cantidad de likes a la vista (Es decir muestra cuantos likes ha tenido dicha receta) ...Por medio de la variable: '$likes'
        $likes = $receta->likes->count();                              


        return view('recetas.show' , compact('receta' , 'like' , 'likes'));  //Le hubieramos tambien podido pasar la info de las recetas por medio de un "with" como lo hemos hecho anteriormente , pero esta forma de hacerlo con "compact" tambien es buena.
    }






    
    /**___________________________________________________________________________________________________________________________
     * 4°Metodo: Edit
     * Show the form for editing the specified resource.
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        $this->authorize('view' , $receta);  //Verificar que el usuario que quiera visulizar la vista para editar una receta este autenticado

        $categorias = CategoriaReceta::all(['id','nombre']);

        return view('recetas.edit' , compact('categorias' , 'receta'));
    }






    /**__________________________________________________________________________________________________________________________________
     * 5°Metodo: Update
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {

        //Revisa el policy
        $this->authorize('update' , $receta);

        
        //Validacion
        $data = request()->validate([    
            'titulo' => 'required|min:4',          
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
        ]); 


        //Actualizando campos
        $receta->titulo = $data['titulo'];
        $receta->categoria_id = $data['categoria'];   //Lo que ponemos dentro de las llaves debe ser los mismo que pusimos en los "name" de los inputs
        $receta->preparacion = $data['preparacion'];
        $receta->ingredientes = $data['ingredientes'];
        
        


        //Actualizar imagen
        // if(request('imagen')){   //Si en caso de que el usuario suba una nueva imagen 

        // $ruta_imagen = ( $request['imagen']->store('upload-recetas', 'public') );   //Guardemela en la base

        // $img = Image::make( public_path("storage/{$ruta_imagen}"))-> fit(1000, 550);  //Apliquele los cambios de tam con interventionImage y guardamela definitly
        // $img->save();

        // //Y asignamos el objeto 
        // $receta->imagen = $ruta_imagen;
        
        //} //__________________________________________________________________________________________

        $receta->save();
        

        //Redireccionamos para que no nos salga la pantalla en blanco
        return redirect()->action('\App\Http\Controllers\RecetaController@index');

    }



    

    /**________________________________________________________________________________________________________________________________________
     * 6°Metodo: delete
     * Remove the specified resource from storage.
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */

    public function destroy(Receta $receta)
    {

        //Ejecutar el Policy
        $this->authorize('delete', $receta);

        //eliminar receta
        $receta->delete();

        //redireccion
        return redirect()->action('\App\Http\Controllers\RecetaController@index');
    }



    //Metodo para el BUSCADOR CON IMAGEN DE FONDO_____________________________________________
    public function search(Request $request)
    {
      //$busqueda = $request['buscar'];   Otra forma de hacerlo
      $busqueda = $request->get('buscar');    //buscar es el mismo que pusimos en el name del input 


      $recetas = Receta::where('titulo', 'like', '%' . $busqueda . '%' )->paginate(4);  //Para esta herramienta de buscador vamos a usar el operador like que nos sirve para esto
      $recetas->appends(['buscar'=> $busqueda]);                 //El caracer de "%" lo poneos para que al poner una palabra busque referencias relacionadas y nos las sugiera en la busqueda
                                                                                                  


      return view('busquedas.show', compact('recetas' , 'busqueda'));       //Le pasamos la variable busqueda a la vista para que el titulo de esa vista sea lo que el usuario busco                     
    } 






}





