
<!-- Aqui lo que hacemos es heredar el estilo que ya esta definido es el archivo: layouts/app.blade.php
     como podemos ver solo basta con poner layouts,app  -->  
@extends('layouts.app')


@section('content')   <!-- Aqui lo que estamos haciendo es ubicar nuestro contenido en una area definida por laravel para las vistas -->


<h1> DESDE PRUEBA.blade.php </h1>
 
{{-- La forma en que vamos a iterar o a hacer referencia a un arreglo en php es con: "FOREACH" --}}

 {{-- Esta es la misma que la llave(primer parametro) , y el segundo parametro es como un alias--}}   

@foreach($recetas as $receta )

<li> {{ $receta }}</li>
    
@endforeach



<h2> CATEGORIAS </h2>
@foreach($categorias as $categoria)

<li> {{ $categoria }} </li>

@endforeach


@endsection