<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    @yield('styles')   <!-- Estilos css de trix editor -->


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm barra">   <!-- Barra superior  -->
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else


                        <!-- BOTON DROP-DOWN en la nav-bar superior  -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                      
                                
                            <!--Boton drop-down Que muestra la op de "ver perfil" -->    
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('perfiles.show' , ['perfil'=>Auth::user()->id]) }}">
                                        {{ 'ver perfil' }}
                                    </a>


                            <!--Boton drop-down Que muestra la op de "ver perfil" -->    
                            
                                <a class="dropdown-item" href="{{ route('recetas.index') }}">
                                    {{ 'ver Recetas' }}
                                </a>        

                            <!--Boton drop-down Que muestra la op de "cerrar sesion" -->
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


<!--  MENU SUPERIOR DE CATEGORIAS DE LAS RECETAS_________________________________________________________________________-->
<nav class="navbar navbar-expand-md navbar-light categorias-bg">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#categorias" aria-controls="categorias" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
            Categorias
        </button>
        <div class="collapse navbar-collapse " id="categorias">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav w-100 d-flex justify-content-between">
                @foreach ($categorias as $categoria)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categorias.show', ['categoriaReceta' => $categoria->id ]) }}">
                       {{ $categoria->nombre }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>



<!-- BUSCADOR CON IMAGEN DE FONDO _______________________________________________________________________________________-->
@yield('hero')




<!--__________________________________________________________-->
<!--  vista: create.blade -->
<div class="container">

    <div class="row">

        <div class="py-4 mt-10 col-12">  <!--Cajita para los botones Vid 56° min:2:21-->
        @yield('botones')
    </div>    


        <main class="py-4 mt-5 col-12">   <!--La etiqueta main en html es para colocar nuestro contenido principal de la vista en especifico , en nuestro caso la usaremos para colocar nuestro contenido principal del metodo create el cual son los formularios etc , que es donde el usuario definira la nueva receta -->
              @yield('content')  <!-- yeild son las areas en las que tu vas a poder meter contenido de vistas , la idea es que 
                    en tu documento de vista vas a poner @section('content') y dentro de esta "etiqueta" vas a poner tu contenido
                    y asi ubicaras tu contenido de la vista de forma correcta , al final cerraras con @endsection.
                    si no hacemos esto a la hora de ver la vista en la pagina esta se vera mal y desorganizada.  -->           
        </main>

    </div>
</div>
<!--__________________________________________________________________________________________-->


    
</div>



@yield('scripts')  <!-- Estilos js de trix editor -->

</body>



</html>
