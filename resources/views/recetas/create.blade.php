

@extends('layouts.app') <!--Heredacion de estilos-->


@section('styles')       <!--Llamando el yield de "styles" que esta en app.blade para el editor trix-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection



<!-- Botones , boton de volver, y uno de ejemplo-->
@section('botones')
                    
<a href="{{ route('recetas.index') }}"  class="btnn btn--2 mr-2 " > <svg class="icono" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
  </svg> Volver </a>

@endsection





<!--_________________________________________________________________________________________________-->

@section('content')  <!--Contenido principal de la vista (formularios para nueva receta)-->

<h2 class="text-center mb-5">  Crear nueva receta  </h2>

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        
<!--FORMULARIO GENERAL-->

                          <!--En ese action vamos a agregar la ruta que tenga el metodo @store para almacenarlo en la base de datos --> 
        <form method="POST" action="{{ route('recetas.store') }}" novalidate  enctype="multipart/form-data"> <!--2°Paso pa almacenar imgs ,El enctype se agrega a la hora de hacer el proceso de almacenar imagenes-->

            @csrf  <!--Esto basicamente lo tenemos que agregar para laravel permita aceptar "request" desde el formulario lo compare con el de app.blade(que es como el general) y asi se ejecutara todo bien , si no hacemos eso saltara error-->
          
            
<!--Formulario para el titulo-->            
            <div class="form-group"> 
                <label for="titulo">Titulo de receta </label>                       <!-- Si agreagamos ese error con esos parametros(que son de boostrap) eso va a permitir que cuando el usuario deje el campo vacio se resalte el imput con rojo (cuestiones de decoracion)-->
                <input id="titulo" class="form-control  @error('titulo') is-invalid @enderror" 
                   type="text" 
                   placeholder="Titulo Receta" 
                   required 
                   name="titulo" 
                   value="{{ old('titulo') }} ">  <!--Ese parametro de "VALUE" , es para que encaso de que haya un error de validacion no se le borre a el usuario lo que ya habia escrito-->

                 
<!--Validacion del titulo de la receta -->                  

                @error('titulo')
                                            <!-- Cuando halla un error en 'titulo' ejecute tal codigo (La idea es que si el usuario envia el titulo de la nueva receta vacio que muestre el mensaje,hay dos maneras 1° poniendo un parafo y la 2° con boostrap la cual es mucho mas bonita)-->
                  <span class="invalid-feedback d-block" role="alert">
                      <strong> {{$message}} </strong>
                  </span>    
                @enderror

            </div>


<!--______________________________________________________________________________________________________________________________-->
<!--Formulario select para que el usuario elija la categoria de la receta que esta creando -->

            <div class="from-group">
                <label for="categoria">categoria</label>

                <select class="form-control @error('categoria') is-invalid @enderror" id="categoria" name="categoria">   

                    <option value="">Seleccione Categoria</option>
                   @foreach($categorias as $categoria)     <!--Llamamos a la variable categorias, a el nombre de la categoria(los que pusimos en el seeder)-->
                         <option value="{{ $categoria->id }}"> {{$categoria->nombre}} </option>  <!-- ya a la hora de mostrar las opciones en el select la idea es mostar los nombres de las categorias, entonces para ello ponemos en medio de las etiquetas "option" : {{ $categoria}}  que como ya dijimos hace alusion a el nombre de las categorias-->
                    @endforeach   
                </select>

<!--Validacion pra categoria-->
                @error('categoria') 
                    {{'Ponga el hijueputa campo lleno'}}
                    <span class="invalid-feedback d-block" role="alert">
                        <strong> {{$message}} </strong>
                    </span>   
                @enderror
            </div>

<!--_____________________________________________________________________________________________________________-->
<br>
<!--Formulario para para ingresar la preparacion-->

<div class="form-group mt-4">
     <label for="preparacion">Preparacion</label>
     <input id="preparacion" type="hidden" name="preparacion" required  value="{{ old('preparacion') }} ">  <!--Ese parametro de "VALUE" , es para que encaso de que haya un error de validacion no se le borre a el usuario lo que ya habia escrito-->

     <trix-editor class="form-control @error('preparacion') is-invalid @enderror"  input="preparacion"></trix-editor>   <!-- Ese parametro del input debe ser el mismo que pusimos en el name de el input de arriba-->
                <!--Y para que se coloree el campo en caso de error agregamos la clase que ya sabemos -->


<!--Validacion para la preparacion-->
@error('preparacion')
<span class="invalid-feedback d-block" role="alert">
    <strong> {{$message}} </strong>
</span>  
@enderror


    </div>

    <!--_____________________________________________________________________________________________________________-->

<!--Formulario para para ingresar los ingredientes  ,  (duplicamos el de preparacion)-->

<div class="form-group mt-4">
     <label for="ingredientes">Ingredientes</label>
     <input id="ingredientes" type="hidden" name="ingredientes" required  value="{{ old('ingredientes') }} ">  <!--Ese parametro de "VALUE" , es para que encaso de que haya un error de validacion no se le borre a el usuario lo que ya habia escrito-->


     <trix-editor class="form-control @error('categoria') is-invalid @enderror" input="ingredientes"></trix-editor>   <!-- Ese parametro del input debe ser el mismo que pusimos en el name de el input de arriba-->


<!--Validacion para los ingredientes-->
@error('ingredientes')
<span class="invalid-feedback d-block" role="alert">
    <strong> {{$message}} </strong>
</span>  
@enderror


    </div>



<!--______________________________________________________________________________________________-->
<br>
<!--Agregar imagenes a la receta -->

<div class="form-group mt-3">
    <label for="imagen">Elige la Imagen</label>

    <input id="imagen" 
    name="imagen" 
    class="form-control @error('imagen') is-invalid @enderror"
    type="file">



<!--Validacion para la imagen-->
@error('imagen')
<span class="invalid-feedback d-block" role="alert">
    <strong> {{$message}} </strong>
</span>  
@enderror


    </div>


<!--_________________________________________________________________________________________________________-->    
<br>
<!--Enviar todos los campos de la receta-->

            <div class="form-group">   <!--Boton para enviar la receta -->
                 <input type="submit" class="btn-primary" value="Agregar receta">
            </div>

        </form>
    </div>
</div>
<!--_________________________________________________________________________________________________________-->

@endsection


@section('scripts')       <!--Llamando el yield de "scripts" que esta en app.blade ,para el editor trix-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>  

<!-- PARA QUE trix editor funcione correctamente debemos agregar a el final de el primer script la palabra defer -->
        @endsection



