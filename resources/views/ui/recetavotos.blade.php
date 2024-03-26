

    <div class="card shadow">
        {{-- <img class="card-img-top" src="/storage/{{ $receta->imagen }}" alt="imagen receta"> --}}
        <div class="card-body">
            <h3 class="card-title text-center font-weight-bold">{{$receta->titulo}}</h3>

              <!--Info de likes-->         
                <p class="centrar"> <svg class="icono text-center" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 66.911 66.911" style="enable-background:new 0 0 66.911 66.911;" xml:space="preserve">
                    <path style="fill:#E34326;" d="M66.911,22.831c0-10.563-8.558-19.122-19.118-19.122c-5.658,0-10.721,2.473-14.223,6.377
                    c-0.037,0.043-0.076,0.085-0.113,0.128c-3.5-3.98-8.618-6.505-14.334-6.505C8.561,3.709,0.005,12.268,0,22.831
                    c0,5.834,2.629,11.059,6.758,14.565H6.751l27.104,25.806l26.308-25.806h-0.012C64.279,33.89,66.911,28.669,66.911,22.831z"/> </svg>  
                    {{ count( $receta->likes)}} Likes
                </p> 
            

              <!--Fecha-->  
                @php
                    $fecha = $receta->created_at
                @endphp
                <p class="text-muted fecha font-weight-bold text-center">
                    <fecha-receta fecha="{{$fecha}}" ></fecha-receta>
                </p>

                
            <p> {{ Str::words(  strip_tags( $receta->preparacion ), 13, ' ...' ) }} </p>

            <a href="{{ route('recetas.show', ['receta' => $receta->id ])}}"
                class="btn btn-outline-danger d-block btn-receta">Ver Receta
            </a>
        </div>
    </div>
