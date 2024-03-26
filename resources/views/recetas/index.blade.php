
@extends('layouts.app')


<!-- Botones -->
@section('botones')
      @include('ui.navegacion')    <!--Como esos botones incluyen tanto codigo , entonces aqui simplemente  enlazamos un archivo donde se encuentran los botones con sus iconos y todo lo demas-->
@endsection



<style>
  
  /*Dar borde curvo a las imagenes pequeñas que se muestran en la tabla de recetas */
  .imgd{
   border-radius: 13%;

  }
  
  </style>
  



<!-- Contenido de la tabla de recetas -->


@section('content')


<h2 class="text-center mb-5">  Administra tus recetas  </h2>

<div class="col-md-10 mx-auto bg-white p-3">

    <table class="table">   
        <thead class="bg-primary text-light">  <!--La clase barra para que el color de fondo sea rojo-->
            <tr>
                <th scole="col"> Titulo </th>
                <th scole="col"> categoria </th>
                <th scole="col"> Acciones </th>
            </tr>
        </thead>


        <tbody>     
            @foreach($recetas as $receta)    <!--Ponemos este foreach para poder mostrar las recetas que ha creado el usuario-->
            
            <tr>
              <!--Campo de titulo en la vista principal -->
                <td> <b> {{$receta->titulo}} </b> 
                  <br> <br>
                  {{-- <img src="{{asset('/storage/'.$receta->imagen)}}" class="ml-4 imgd" width="200" height="120"> <!--Imagen de vista rapida , chiquit --> --}}
                </td>


                <td>  <b> {{$receta->categoria->nombre}} </b> </td>  <!--Ese parametro de categoria es el nombre de el metodo que definimos en el Modelo: Receta.php  -->
                <td> 
                     <!--Botones de la 3 columna "Acciones"-->

            <!--_____________________________________________________________________________________________-->

                     <!--BOTON DE ELIMINAR RECETA-->
                     
                     <!-- Forma primitiva (elimina automaticamente con el click)
                     <form action="{{route('recetas.destroy',['receta'=> $receta->id])}}" method="POST">
                        @csrf  
                        @method('DELETE')    Le agregamos el: method="" a el form ,Pero como sabemos ese atributo en formato html solo soporta los metodos "get" y "post" ;  entonces lo dejamos como POST  y abajito en formato php referenciamos que ese metodo en realidad es "delete" ....     Ese llamado en formato php quedaria   @method('DELETE')
                        <input type="submit" class="btn btn-danger d-block w-100 mb-2" value="Eliminar &times;">
                     </form>
                     -->

                <!--Forma de hacerlo con el componente de Vue.js  -->
                <eliminar-receta receta-id={{$receta->id}}> 
                
                </eliminar-receta>  <!--Llamamos a el componente Vue.js que es donde configuramos nuestro boton -->

            <!--____________________________________________________________________________________________-->

                    <!--BOTON DE EDITAR RECETA-->
                    <a href="{{route('recetas.edit',['receta'=> $receta->id])}}" class="btn btn-dark d-block mb-2">Editar</a>       
                    
            <!--____________________________________________________________________________________________-->

                    <!--BOTON DE VER RECETA-->
                    <a href= "{{route('recetas.show',['receta'=> $receta->id ])}}"  class="btn btn-success d-block "> Ver </a>
                             <!--Alias de la ruta-->


                </td>             
            </tr>
                
            @endforeach
        </tbody>

     </table>

     
  <!--Vista en si de la paginacion de las recetas  -->   
 <div class="col-12 mt-4 justify-content-center d-flex mb-5">    
{{$recetas->links() }}  
</div>




<!-- Apartado de Lista con las recetas a las que el usuario le ha dado like ________________________________________________-->
<h2 class="text-center mt-5"> Recetas que te gustan </h2>
<div class="col-md-10 mx-auto bg-white p-3">
     
    @if( count( $usuario->meGusta) > 0 )    <!-- Si el usuario tiene recetas a las que le ha dado like muestreselas, si no avisele que aun no ha calificado ninguna -->

     <ul class="list-group">
        @foreach($usuario->meGusta->take(6) as $receta)   <!--Le ponemos 'take' para que solo muestre 6 , ya que la lista en determinado momento se hara muy larga-->
        
        <li class="list-group-item d-flex justify-content-between align-items-center">
                 <p> <b> {{$receta->titulo}} </b>  </p>
                 
                 <a href="{{route('recetas.show',['receta'=> $receta->id ])}}"  class="btn btn-outline-success "> Ver receta </a>
            </li>         
        @endforeach
     </ul>

<a class="mt-3" href=""> Ver mas ...</a>   <!--pendiente-->

     @else
         <p class="text-center"> <b> Aun no tienes recetas guardadas </b>  
            <small>Dale like a las recetas y apareceran aqui</small> </p>
     @endif


</div>



   </div>
@endsection