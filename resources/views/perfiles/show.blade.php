@extends('layouts.app')

@section('botones')
    <a href="{{ route('recetas.index') }}"  class="btnn btn--2 mr-2" > <svg class="icono" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
      </svg> Volver </a>  
@endsection


<!--------------------------------------------------------------------->


  @section('content')
<div class="container">
    <div class="row">
        <!--Mostar imagen-->
        <div class="col-md-5">
          @if($perfil->imagen)  <!--Si existe la imagen muestrela , si no , no muestre nothing-->
          <img src="/storage/{{$perfil->imagen}}" class="w-100 rounded-circle" alt="imagen chef">

          @else
          <figure>
          <img src="/storage/upload-perfiles/cheff.png" class="w-100 rounded-circle">
          <figcaption class="text-center"> Sin foto de perfil </figcaption> 
        </figure>
         
          @endif


        </div>


        <div class="col-md-7 mt-5">
             <h2 class="text-center mb-2 text-primary"> {{$perfil->usuario->name}} </h2>   <!--Nombre del perfil -->
             
             <a href="{{$perfil->usuario->url}}">Visitar sitio web</a>   <!-- Link del sitio web del usuario -->

             <h5>{{ $perfil->emailp }}</h5>  <!--Mostrar email de contacto , no sirve por elmomento ya que aun no se ha configurado que se guarde en b.datos-->


             <!--Biografia del perfil -->
             @if($perfil->biografia)
             <div class="biografia">
                 {!! $perfil->biografia !!}   
             </div>
             @else
                  <p> <b> Sin Biografia </b> </p>
             @endif

        </div>
    </div>
</div>



<!-- MOSTRAR EN EL PERFIL LAS RECETAS QUE HA CREADO EL USUARIO _____________________________________________ -->

<h2 class="text-center my-5"> <b> Recetas credas por: {{$perfil->usuario->name}} </b> </h2>

<div class="container">
  <div class="row mx-auto bg-white p-4">

    @if(count($recetas) > 0 )   <!--Si la cantidad de recetas es mayor a 0 , vamos a mostrarlas-->
    
    @foreach($recetas as $receta)
   <div class="col-md-4 mb-4">
     <div class="card">
       <!--Imagen de la receta con link , para q al pasar el cursor de la opcion de click-->
      <a href="{{route('recetas.show',['receta'=> $receta->id ])}}"> <img src="{{asset('/storage/'.$receta->imagen)}}" class="borde card-img-top" alt="imagen receta"> </a>  <!--Asi mostramos las imagenes de las recetas que ha creado el usuario , con pginacion 2 -->

          <!-- Nombre de la receta -->
           <div class="card-body">
             <h3> {{$receta->titulo}}</h3>
           </div>

     </div>
   </div>  
    @endforeach
    
    <!--Boton de paginacion-->
   <div class="col-12 mt-4 justify-content-center d-flex">    
    {{$recetas->links() }}  <!--Mostrar la paginacion de las recetas -->
    </div>

    @else
           <p class="text-center w-100"> Aun No hay recetas creadas</p>
    @endif

  </div>
</div>

@endsection