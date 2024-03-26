
<!--Codigo para mostrar las categorias juntos con sus respectivas recetas en la vista HomePrincipal -->

<div class="card shadow mt-5">
    {{-- <a href="{{route('recetas.show',['receta'=> $receta->id ])}}">  <img src="/storage/{{$receta->imagen}}" height="450" class="card-img-top adaptarse" alt="Receta">  </a> --}}
      <div class="card-body">
        <h5 class="card-title text-center font-weight-bold"> {{$receta->titulo}} </h5>
        <p class="card-text text-center mx-3"> {{ Str::words( strip_tags($receta->preparacion), '40','...') }}</p>  
         
         @php
         $fecha = $receta->updated_at ;  
         @endphp        
       <p class="card-text text-center"> <small class="text-muted text-primary">Last udapted at  <fecha-receta fecha="{{ $fecha }}"></fecha-receta> </small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
          <svg class="icono" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
          viewBox="0 0 66.911 66.911" style="enable-background:new 0 0 66.911 66.911;" xml:space="preserve">
          <path style="fill:#E34326;" d="M66.911,22.831c0-10.563-8.558-19.122-19.118-19.122c-5.658,0-10.721,2.473-14.223,6.377
          c-0.037,0.043-0.076,0.085-0.113,0.128c-3.5-3.98-8.618-6.505-14.334-6.505C8.561,3.709,0.005,12.268,0,22.831
          c0,5.834,2.629,11.059,6.758,14.565H6.751l27.104,25.806l26.308-25.806h-0.012C64.279,33.89,66.911,28.669,66.911,22.831z"/> </svg>  
          {{ count( $receta->likes)}} Likes   
       </p>
        
     <a class="col-1 centrar mb-2 btn btn-outline-success" href="{{route('recetas.show',['receta'=> $receta->id ])}}">  Ver </a>
      </div>
    </div>