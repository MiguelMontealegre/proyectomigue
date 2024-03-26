
@extends('layouts.app') <!--Heredacion de estilos-->


@section('styles')       <!--Llamando el yield de "styles" que esta en app.blade para el editor trix-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection



<!-- Botones , boton de volver, y uno de ejemplo-->
@section('botones')
    <a href="{{ route('recetas.index') }}"  class="btnn btn--2 mr-2" > <svg class="icono" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
      </svg> Volver </a>  
@endsection

<!--Estilos para botones neon_______________________________________-->
<style>
  .btnn {
    line-height: 30px;
    text-decoration: none;   
    text-align: center;
    margin-top: 15px;
    margin-right: 15px;  
    position: relative;
    display: block;
    height: 39px;
    width: 120px;
    border-radius: 4px;
    text-transform: uppercase;
    background-color: transparent;
    color: black;
    font-size: 12px;
    overflow: hidden;
    transition: all 500ms ease;
    border: 2px solid #20e2d7;
    margin-bottom: 40px;
    z-index: 0;
    font-weight: 700;
    cursor: pointer;
  }
  .btnn::before {
    content: "";
    position: absolute;
    left: 0;
    text-decoration: none; 
    right: 0;
    top: 0;
    margin: auto;
    background-color: #20e2d7;
    transition: all 500ms ease;
    z-index: -1;
  }
  
  
  .btn--2:hover {
    text-decoration: none; 
    background-color: #20e2d7;
    box-shadow: 0 0 10px #20e2d7, 0 0 20px #20e2d7, 0 0 20px #20e2d7;
    color: white;
  }
  
  @keyframes shadow-pulse {
    0% {
      box-shadow: 0 0 0 0 rgba(32, 226, 215, 0.6);
    }
    100% {
      box-shadow: 0 0 8px 16px rgba(32, 226, 215, 0);
    }
  }
  </style>
 <!--_____________________________________________________________________-->




<!--_________________________________________________________________________________________________-->





@section('content')  <!--Contenido principal de la vista (formularios para editar la receta)-->

<h2 class="text-center mb-5">  Edita tu receta:   {{$receta->titulo}}  </h2>



<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        
<!--FORMULARIO GENERAL-->

          <!--Ese post se mantiene , Ese action va a cambiar un poco , le vamos a agregar la ruta que tenga el metodo @update para almacenarlo en la base de datos --> 
        <form method="POST" action="{{ route('recetas.update' , ['receta'=> $receta->id]) }}" novalidate  enctype="multipart/form-data"> <!--2°Paso pa almacenar imgs ,El enctype se agrega a la hora de hacer el proceso de almacenar imagenes-->

            @csrf  <!--Esto basicamente lo tenemos que agregar para laravel permita aceptar "request" desde el formulario lo compare con el de app.blade(que es como el general) y asi se ejecutara todo bien , si no hacemos eso saltara error-->
          
            @method('put')  <!-- Esto esta conectado a el method de la linea 36 , Lo tenemos que agregar aqui y de esta forma ya que arriba en linea 36 , html no soporta ese formato de verbo , tonces lo hacemos de esta manera -->
            

            
<!--Formulario para EDITAR el titulo-->            
            <div class="form-group"> 
                <label for="titulo">Titulo de receta </label>                       
                <input id="titulo" class="form-control  @error('titulo') is-invalid @enderror" 
                   type="text" 
                   placeholder="Titulo Receta" 
                   required 
                   name="titulo" 
                   value="{{ $receta->titulo }} ">  <!--El parametro de "VALUE" lo cambiamos y ponemos el valor que tenia originalmente , asi el usuario podra ver que tenia antes para asi poner uno nuevo-->

                 
<!--Validacion del titulo de la receta -->                  

                @error('titulo')
                                            <!-- Cuando halla un error en 'titulo' ejecute tal codigo (La idea es que si el usuario envia el titulo de la nueva receta vacio que muestre el mensaje,hay dos maneras 1° poniendo un parafo y la 2° con boostrap la cual es mucho mas bonita)-->
                  <span class="invalid-feedback d-block" role="alert">
                      <strong> {{$message}} </strong>
                  </span>    
                @enderror

            </div>


<!--______________________________________________________________________________________________________________________________-->
<!--Formulario select para que el usuario EDITE la categoria de la receta  -->

            <div class="from-group">
                <label for="categoria">categoria</label>

                <select class="form-control @error('categoria') is-invalid @enderror" id="categoria" name="categoria">   

                    <option value="">Seleccione Categoria</option>
                   @foreach($categorias as $categoria)     <!--Llamamos a la variable categorias, a el nombre de la categoria(los que pusimos en el seeder)-->
                         <option value="{{ $categoria->id }}"
                            {{$receta->categoria_id == $categoria->id ? 'selected': ''}} 
                            > {{$categoria->nombre}} </option>  <!-- ya a la hora de mostrar las opciones en el select la idea es mostar los nombres de las categorias, entonces para ello ponemos en medio de las etiquetas "option" : {{ $categoria}}  que como ya dijimos hace alusion a el nombre de las categorias-->
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
<!--Formulario para EDITAR la preparacion-->

<div class="form-group mt-4">
     <label for="preparacion">Preparacion</label>
     <input id="preparacion" type="hidden" name="preparacion" required  value="{{ $receta->preparacion}} ">  <!--El parametro de value otra vez lo cambiamos para que se muestr el que estaba originalmente-->

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

<!--Formulario para EDITAR los ingredientes -->

<div class="form-group mt-4">
     <label for="ingredientes">Ingredientes</label>
     <input id="ingredientes" type="hidden" name="ingredientes" required  value="{{ $receta->ingredientes }} ">  


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
<!--Editar imagenes de la receta -->

<div class="form-group mt-3">
    <label for="imagen">Elige la Imagen</label>

    <input id="imagen" 
    name="imagen" 
    class="form-control @error('imagen') is-invalid @enderror"
    type="file">


<!--Para que el usuario identifique que imagen tiene originalmente -->    
<div class="mt-4">

    <p> Imagen actual:  </p>

    <img src="{{asset('/storage/'.$receta->imagen)}}" width="300px">

</div>



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
                 <input type="submit" class="btn-primary" value="Actualizar receta">
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


