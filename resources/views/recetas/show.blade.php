@extends('layouts.app')

@section('botones')
    <a href="{{ route('recetas.index') }}"  class="btnn btn--2 mr-2" > <svg class="icono" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
      </svg> Volver </a>  
@endsection




@section('content')

<!--Titulo-->
<article class="contenido-receta bg-white p-5 shadow">
    <h1 class="text-center mb-4">{{$receta->titulo}}</h1>
    



<!--Imagen de receta-->

{{-- <div class="imagen-receta">
    <img src="{{asset('/storage/'.$receta->imagen)}}" class="w-100">
</div> --}}



<!--Info Meta-->

<div class="receta-meta mt-4">

    <!--Mostar categoria ____________________________________-->
    <p>
        <span class="font-weight-bold tex-primary">Categoria</span>
            <a href=" {{route('categorias.show', ['categoriaReceta' => $receta->categoria->id ])}} "> {{$receta->categoria->nombre}} </a>   
    </p>



    <!--Mostrar el USUARIO que la creo ____________________________-->
    <p>
        <span class="font-weight-bold tex-primary">Autor: </span>
                                                   
      <a href="{{route('perfiles.show',['perfil'=> $receta->user_id ])}}"> {{$receta->autor->name}}  </a>   <!--Tuvimos que crear una relacion en el model receta.php -->
    </p>                                            <!-- ->autor->id -->
        
    
  <!--   ID DEL AUTOR      
    <p>
        <span class="font-weight-bold tex-primary">ID del Autor: </span>
        {{$receta->user_id}}
    </p>                         -->


    <!-- Fecha de creacion_________________________________________________ -->

    <p>
        <span class="font-weight-bold tex-primary">Fecha de creacion </span>
       
@php
  $fecha = $receta->created_at ;  
@endphp

<fecha-receta fecha="{{ $fecha }}"></fecha-receta>   <!-- Etiqueta de vue .. video 82-->
    </p>


    <!-- Fecha de la ultima actualizacion _____________________________________--->
    <p>
      <span class="font-weight-bold tex-primary"> Ultima actualizacion  </span>
     
@php
$fecha = $receta->updated_at ;  
@endphp

<fecha-receta fecha="{{ $fecha }}"></fecha-receta>   <!-- Etiqueta de vue .. video 82-->
  </p>


<!--_____________________________________________________________-->    
   

    <!-- Ingredientes ______________________________ -->
    <div class="ingredientes">
        <h2 class="my-3 text-primary font-weight-bold"> Ingredientes </h2>

        {!!$receta->ingredientes!!}
        <!-- Le agregamos esa sintaxis para mostrar los ingredientes ya que si lo hacemos normalmente ($receta->ingredientes) nos va a salir codigo html en nuestro texto , por lo cual debemos agregarle esos !!  -->
    </div>


    <!-- PREPARACION_____________________________________________  --->
    <div class="preparacion">
        <h2 class="my-3 text-primary font-weight-bold"> preparacion </h2>

        {!!$receta->preparacion!!}
        <!-- Le agregamos esa sintaxis para mostrar los ingredientes ya que si lo hacemos normalmente ($receta->ingredientes) nos va a salir codigo html en nuestro texto , por lo cual debemos agregarle esos !!  -->
    </div>



<!--Componente Vue.js Para el boton de like en las recetas -->  
<div class="justify-content-center row text-center">

  <like-button class="mt-4"
      receta-id="{{$receta->id}}"
      like="{{$like}}"
      likes="{{$likes}}"
  ></like-button>

</div>





  </div>
</article>
@endsection