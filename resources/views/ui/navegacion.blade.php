

<!--Aqui la idea es poner el link de el boton, ya que la cajita de css la pusimos en app.blade que es como el diseño general -->

<!--  Aqui estamos llamando el alias de la ruta -->


<a  href="{{ route('recetas.create') }}"      class="btn btn-outline-success mr-4 text-black font-weight-bold"> <svg class="icono" xmlns="http://www.w3.org/4000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
  </svg> Crear Receta  </a>
  
  <a  href="{{ route('perfiles.edit' , ['perfil'=>Auth::user()->id]) }}"  class="btn btn-outline-info mr-4 text-black font-weight-bold"> <svg class="icono" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
  </svg>
     Editar Perfil  </a>
  
  <a  href="{{ route('perfiles.show' , ['perfil'=>Auth::user()->id]) }}"  class="btn btn-outline-danger mr-4 text-black font-weight-bold">
    <svg class="icono" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg> Ver Perfil  </a>


  