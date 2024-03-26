@extends('layouts.app')


@section('styles')       <!--Llamando el yield de "styles" que esta en app.blade para el editor trix-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection



<!-- Botones , boton de volver, y uno de ejemplo-->
@section('botones')                    
    <a href="{{ route('recetas.index') }}"  class="btnn btn--2" ><svg class="icono" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
      </svg> Volver </a>

@endsection

<!--Estilo para el boton neon de volver______________________-->
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



<!--_____________________________________________________________________________________________-->

@section('content')

<h1 class="text-center"> EDITAR DATOS DE MI PERFIL </h1>

<div class="row justify-content-center mt-5">

     <div class="col-md-10 bg-white p-3">


        
                 <!--RECORDEMOS QUE EN EL ACTION vamos a definir a donde se va a mandar esta actualizacion de datos , generalmente simpre la mandaremos a el metodo update -->
       <form action="{{route('perfiles.update', ['perfil' => $perfil->id])}}"     
        method="POST"
        enctype="multipart/form-data">  <!--Recordemos que para trabajar con imgs tenemos que poner esto -->

        @csrf    <!--Colocamos el token -->
        @method('PUT')   <!--Y como ya sabemos que en la parte anterior solo soporta los 2 metodos clasicos , aqui referenciamos el metodo que es (PUT) -->



<!--Formulario para EDITAR el nombre del perfil-->            
        <div class="form-group"> 
            <label for="nombre">Nombre  </label>                       
            <input id="nombre" class="form-control  @error('nombre') is-invalid @enderror" 
               type="text" 
               placeholder="Digita tu nuevo nombre" 
               required 
               name="nombre" 
              value="{{ $perfil->usuario->name }}">  <!--En el parametro de "VALUE" ponemos el valor que tenia originalmente , asi el usuario podra ver que tenia antes para asi poner uno nuevo-->

             
<!--Validacion del nombre del perfil -->                  

            @error('nombre')
                                        <!-- Cuando halla un error en 'titulo' ejecute tal codigo (La idea es que si el usuario envia el titulo de la nueva receta vacio que muestre el mensaje,hay dos maneras 1° poniendo un parafo y la 2° con boostrap la cual es mucho mas bonita)-->
              <span class="invalid-feedback d-block" role="alert">
                  <strong> {{$message}} </strong>
              </span>    
            @enderror

        </div>


<!---------------------------------------------------------------->
<!--Correo de contacto -->

<div class="form-group">

    <label for="emailp"> Correo de contacto </label>

    <input type="email" id="emailp" class="form-control"  name="emailp"
    value="{{ $perfil->usuario->email}} ">

    
    
    @error('emailp')
    <!-- Cuando halla un error en 'titulo' ejecute tal codigo (La idea es que si el usuario envia el titulo de la nueva receta vacio que muestre el mensaje,hay dos maneras 1° poniendo un parafo y la 2° con boostrap la cual es mucho mas bonita)-->
<span class="invalid-feedback d-block" role="alert">
<strong> {{$message}} </strong>
</span>    
@enderror

</div>



<!---------------------------------------------------------------->

    <!--Formulario para EDITAR La url asociada a tu sitio web-->            
        <div class="form-group"> 
            <label for="url">url </label>                       
            <input id="url" class="form-control  @error('url') is-invalid @enderror" 
               type="text"  
               required 
               name="url" 
               value="{{ $perfil->usuario->url}}">

             
<!--Validacion de la url asociada a tu sitio web -->                  

            @error('url')
                                        <!-- Cuando halla un error en 'titulo' ejecute tal codigo (La idea es que si el usuario envia el titulo de la nueva receta vacio que muestre el mensaje,hay dos maneras 1° poniendo un parafo y la 2° con boostrap la cual es mucho mas bonita)-->
              <span class="invalid-feedback d-block" role="alert">
                  <strong> {{$message}} </strong>
              </span>    
            @enderror

        </div>


<!----------------------------------------------->        
<!--Formulario para EDITAR la Biografia-->

<div class="form-group mt-4">
    <label for="preparacion">Edita tu biografia</label>
    <input id="biografia" type="hidden" name="biografia" required value="{{ $perfil->biografia}}" >  

    <trix-editor class="form-control @error('biografia') is-invalid @enderror"  input="biografia"></trix-editor>   <!-- Ese parametro del input debe ser el mismo que pusimos en el name de el input de arriba-->
               <!--Y para que se coloree el campo en caso de error agregamos la clase que ya sabemos -->


<!--Validacion para la biografia-->
@error('biografia')
<span class="invalid-feedback d-block" role="alert">
   <strong> {{$message}} </strong>
</span>  
@enderror

</div>


<!------------------------------------------------>
<!--Editar imagen del perfil-->

<div class="form-group mt-3">
    <label for="imagen">Elige la Imagen</label>

    <input id="imagen" 
    name="imagen" 
    class="form-control @error('imagen') is-invalid @enderror"
    type="file">


<!--Para que el usuario identifique que imagen tiene originalmente -->   
@if($perfil->imagen)  <!-- Si hay una imagen previa mostrarla , si no NO -->
 
<div class="mt-4">
    <p> Imagen actual:  </p>
    <img src="{{asset('/storage/'.$perfil->imagen)}}" width="300px">  -->

</div>


<!--Validacion para la imagen-->
@error('imagen')
<span class="invalid-feedback d-block" role="alert">
    <strong> {{$message}} </strong>
</span>  
@enderror

@endif

    </div>


<!--_________________________________________________________________________________________________________-->    
<br>
<!--Enviar todos los campos de el perfil -->

            <div class="form-group">   <!--Boton para enviar la receta -->
                 <input type="submit" class="btn-primary" value="Actualizar perfil">
            </div>

        </form>
    </div>
</div>
       </form>

     </div>

</div>

@endsection




@section('scripts')       <!--Llamando el yield de "scripts" que esta en app.blade ,para el editor trix-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>  
<!-- PARA QUE trix editor funcione correctamente debemos agregar a el final de el primer script la palabra defer -->
        @endsection