<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//  En este apartado de las rutas encontramos las url principales , EN esta especificamente llamada "web" vamos a 
//  usarla para mostrar alguna vista es decir codigo front end(html,css,javascript,etc)
//  Y por otro lado esta la url "api" la cual se recomienda para mostrar respuestas json.



//Vista principal de la PAGINA !!
Route::get('/', '\App\Http\Controllers\InicioController@index')->name('inicio.index');




// URL del sitio de prueba
Route::get('/prueba', '\App\Http\Controllers\PruebaController');
/*          URL             Controlador                    */


//_________________________________________________________________________________________________


Route::get('/recetas', '\App\Http\Controllers\RecetaController@index')->name('recetas.index');
//            url              controller                     @metodo

// Ruta para el apartado de "crear recetas"                                    Este alias no es necesario pero es muy recomendado ya que en caso de cambiar la url no tendriamos necesidad de cambiar eso en todos los demas documentos
Route::get('/recetas/create', '\App\Http\Controllers\RecetaController@create')->name('recetas.create'); //Ya que si usamos el alias para referenciar la url (primer parametro) en otros documentos para seguir las rutas ,en caso de un cambio se va a actualizar automaticamente.
//Asi nos va a cargar el metodo de create ubicado en nuestor controller principal (recetas)

route::post('/recetas', '\App\Http\Controllers\RecetaController@store')->name('recetas.store');
route::get('/recetas/{receta}', '\App\Http\Controllers\RecetaController@show')->name('recetas.show');
//ese atributo {receta} tiene que ser el mismo del modelo

route::get('/recetas/{receta}/edit', '\App\Http\Controllers\RecetaController@edit')->name('recetas.edit');
route::put('/recetas/{receta}' , '\App\Http\Controllers\RecetaController@update')->name('recetas.update');
route::delete('/recetas/{receta}' , '\App\Http\Controllers\RecetaController@destroy')->name('recetas.destroy');  

//Route::resource('recetas' , '\App\Http\Controllers\RecetaController'); //!ESTO ES LO MISMO QUE TODAS LAS RUTAS ANTERIORES JUNTAS , PERO SIMPLIFICADO


//___________________________________________________________________________________________________________



//Rutas para los perfiles
Route::get('/perfiles/{perfil}', '\App\Http\Controllers\PerfilController@show')->name('perfiles.show');
route::get('/perfiles/{perfil}/edit', '\App\Http\Controllers\PerfilController@edit')->name('perfiles.edit');
route::put('/perfiles/{perfil}' , '\App\Http\Controllers\PerfilController@update')->name('perfiles.update');


//Ruta pra el controller de 'likes'
route::post('/recetas/{receta}', '\App\Http\Controllers\LikesController@update')->name('likes.update');



//RUTA PARA LAS CATEGORIAS DE EL MENU SUPERIOR DE RECETAS
Route::get('/categoria/{categoriaReceta}', '\App\Http\Controllers\CategoriasController@show')->name('categorias.show');



//Ruta PARA EL BUSCADOR CON IMAGEN DE FONDO   --> En este caso no hay necesidad de crear un nuevo controller , se puede hacer con "RecetaController" ...Pero en caso de querer crear un nuevo controller es exactamente igual
Route::get('/buscar', '\App\Http\Controllers\RecetaController@search')->name('buscar.show');


//RUTA CURSO QUERY BUILDER
Route::get('/queryBuilder', '\App\Http\Controllers\querybuilderController@test');


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

