@extends('layouts.app')


<!-- ESTILOS DE OWL CAROUSEL -->
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
@endsection




<!-- BUSCADOR CON IMAGEN DE FONDO __________________________________________________________________________-->

@section('hero')

<div class="hero-categorias">
    <form action="{{ route('buscar.show') }}" class="container h-100">
         <div class="row h-100 align-items-center">   <!-- align-items-center  Para que se centre el contenido verticalmente -->
            <div class="col-md-4 texto-buscar">

               <p class="display-4"> Encuentra una receta para tu proxima comida </p>   <!-- display-4  Para que el texto se vuelva un poco mas grande -->
               <input type="search" name="buscar" class="form-control" placeholder="Buscar receta">

            </div>
         </div>
    </form>
</div>

@endsection










<!-- CARRUSEL CON LAS RECETAS MAS RECIENTES  ___________________________________________________________________________________________-->
@section('content')

<div class="container nuevas-recetas">
 
    <h2 class="titulo-categoria text-uppercase mt-3 mb-4 font-weight-bold"> Ultimas recetas </h2>
    
    <div class="owl-carousel owl-theme">
         @foreach($nuevas as $nueva)
         
        <div class="card">     
            {{-- <a href="{{route('recetas.show',['receta'=> $nueva->id ])}}">  <img src="/storage/{{$nueva->imagen}}" class="card-img-top" alt="imagen receta">  </a>   <!--Imagen de receta--> --}}
 
                  <!--Titulo de la receta-->
                  <div class="card-body">
                        <h3 class="font-weight-bold"> {{Str::title( $nueva->titulo) }}</h3>

            <p class="text-center"> {{ Str::words( strip_tags( $nueva->preparacion) , 11) }}     <a href="{{route('recetas.show',['receta'=> $nueva->id ])}}"> <b> . . .</b> </a>  </p>    
             <!--La funcion strip_tags() de php lo que hace es que cunado encuentra codigo html lo oculta -->
             <!-- Y el poderosisimo helper de strings: str::words() ,Lo que nos permite es recortar la cntidad de palabras que nosotros deseemos , por lo cual nos sirve en este caso que queremos es mostrar un resumen de la preparacion de la receta -->

             <!--Otros tipos de metodos-Helpers Para strings -->
             <!-- str::upper()    Muestra todo el string el mayusculas-->
             <!--str::ucfirts()   Muestra la primera letra del string en mayuscula-->
             <!--str::title()    Muestra la primera letra de cada string en mayusculas-->

             <!-- TODOS LOS HELPERS SE PUEDEN ENCONTARR EN LA DOCUMENTACION DE LARAVEL , HAY OARA ARREGLOS , PATHS Y MUCHAS COSAS INTERESANTES -->
                       
     <p class="text-success text-center">Creada Por {{ $nueva->autor->name}}</p>

                        <a href="{{route('recetas.show',['receta'=> $nueva->id ])}}" class="btn btn-outline-danger font-weight-bold"> Ver receta</a>
                  </div>
          </div>   
         @endforeach

    </div>
</div>






<!-- Mostrar RECETAS MAS VOTADAS POR LIKES______________________________________________________________________________ -->
<div class="container">
       <h2 class="titulo-categoria font-weight-bold mt-5 mb-4">Recetas mas votadas </h2>
       
  <div class="row">
         <div class="owl-carousel owl-theme">
            @foreach($votadas as $receta)                             
               @include('ui.recetavotos')   <!--Toda la sintaxis de este carrusel la minimizamos para que no haya tanto trafico en el codigo-->
            @endforeach 
         </div>       
  </div>
</div>





<!--________________________________________________________________________________________________________________-->
<!-- En esta seccion vamos a mostrar en forma de grupo Los nombres de las categorias de las recetas, y algunas recetas
     correspondientes a cada grupo , por lo cual vamos a hacer con arreglos ...Entonces van a ser 3 Foreach y van a estar
     Anidados es decir uno dentro del otro  -->


<!-- Mostrar el NOMBREE de las categorias de las recetas por grupos____________________________________________________________ -->
@foreach($recetas as $key => $grupo)
<div class="container">
     <h2 class="titulo-categoria font-weight-bold mt-5 mb-4"> {{ str_replace( '-' , ' ' , $key) }} </h2>
     <!--Como Los titulos nos van a aparecer con guiones entre cada palabra entonces vamos a usar la funcion "str_replace()" Para remplazar los guiones por espacios ... esta herramienta funciona con 3 parameros: el primero se pone que caracter se quiere remplazar , el segundo se pone por cual caracter se quiere poner , y el tercero se pone en donde se va a encontrar el string -->



<!--Mostrar las recetas correspondientes a cada grupo --> 
<div class="row">
   @foreach($grupo as $recetas)   <!-- Hasta este foreach las recetas estan agrupadas en grupos de 3-->
       <div class="owl-carousel owl-theme">
          @foreach($recetas as $receta)   <!--Ya con este foreach las recetas se iteran individualmente y las podemos imprimir-->                            
            @include('ui.recetacats')   <!--Toda la sintaxis de este carrusel la minimizamos para que no haya tanto trafico en el codigo-->
          @endforeach 
       </div>       
   @endforeach
</div>
</div> 
@endforeach



@endsection


