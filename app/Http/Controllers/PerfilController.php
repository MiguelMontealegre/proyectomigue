<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

//Metodo para proteger la reedirecion y accesos de ls rutas 
     public function __construct()
{
      $this->middleware('auth' , ['except' => 'show']);  // De esta forma estamos habilitando un middleware una vez que se crea una instancia 
}                                                        // de perfilController y por lo tanto estamos protegiendo a los demas metodos


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }





    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {  
       //Obtener las recetas con paginacion
        $recetas = Receta::where('user_id' , $perfil->user_id)->paginate(3);

        return view('perfiles.show', compact('perfil' , 'recetas'));   //Aqui retornamos la vista de el perfil , y con el compact le enviamos la info de ese perfil a esa vista
    
    }






    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //Revisa el policy  
        $this->authorize('view' , $perfil);  //Bloqueando la vista de editar perfil para usuarios no registrados

        return view('perfiles.edit', compact('perfil'));
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {

        //Revisa el policy
        $this->authorize('update' , $perfil);
        

        //Validacion
        $data = request()->validate([
        'nombre' => 'required|min:2',          // Y le pasamos "validate"(que es un metodo que existe en el request) , y despues le pasamos un arreglo con lo que se va a validar en este caso "required" pa que sea obligatorio (puedes aplicar variaciones de acuerdo a las reglas de validacion como maxima cantidad de caracteres ,minima etc)
        'url' => 'required',
        'biografia' => 'required'
        ]);
    

    //imagen
    if($request ['imagen'] ){
         //ruta
        $ruta_imagen = ( $request['imagen']->store('upload-perfiles', 'public') );
        //Resize de la imagen...                                                          //Mismo codigo usado en controllerRectas: metodo store seccion de img
         $img = Image::make( public_path("storage/{$ruta_imagen}"))-> fit(600, 600);
         $img->save();  //Y agregandole save le decimos que lo guarde en el servidor

         //arreglo
         $array_imagen = ['imagen' => $ruta_imagen];
    }
 
    
    //GUARDAR INFORMACION___________________________
    //Asignar nombre,url
    auth()->user()->url = $data['url'];
    auth()->user()->name = $data['nombre'];
    auth()->user()->save();

    //Eliminar url y name de $data
    unset($data['url']);
    unset($data['nombre']);


    //Asignar Biografia,imagen
    auth()->user()->perfil()->update(array_merge(

        $data,
        $array_imagen?? []        //Video105 ... Aqui lo que hacemos es unir 2 arrlegos con la funcion 'arrayMerge'
    ));
    
   
    //_______________________________________________


    //redireccionar
    return redirect()->action('\App\Http\Controllers\RecetaController@index');

    }
    





    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
