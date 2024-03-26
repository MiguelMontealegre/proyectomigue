
@extends('layouts.app')

<!-- VISTA A LA QUE REDIRIGE EL MENU SUPERIOR DE CATEGORIAS -->
@section('content')

<div class="container">
    <h2 class="titulo-categoria font-weighr-bold text-uppercase">  {{ $categoriaReceta->nombre }} </h2>

    
         @foreach($recetas as $receta)
              @include('ui.recetacats')
         @endforeach
    

      <!-- PAGINACION -->
    <div class="d-flex justify-content-center mt-5">
         {{$recetas->links()}}
    </div>

</div>

@endsection