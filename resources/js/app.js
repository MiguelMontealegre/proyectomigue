/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


//Aqui importamos owl-carousel
import 'owl.carousel';


//Aqui importamos la herramienta de sweet-alert que instalamos
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css'; //Y aqui cargamos los estilos

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);


 //Y aqui activamos la herramienta de sweet-alert
 Vue.use(VueSweetalert2);


//Resulta que hay algunas etiquetas como la de trix-editor que no son propias de lenguaje de programacion , entonces Vue.js
// va a pensar que es un componente , pero como tampoco es un componente entonces aqui lo que le estamos diciendo a Vue.js es que ignore tales etiquetas
//Esto lo hacemos para que no salga un error en la consola
  Vue.config.ignoredElements = ['trix-editor' , 'trix-toolbar'];



//Componente Para Moment.Js  video 82
  Vue.component('fecha-receta', require('./components/FechaReceta.vue').default);
              //El nombre que le demos al 1° parametro va a ser el mismo que usemos como etiqueta
 

//Componente para boton de eliminar
  Vue.component('eliminar-receta' ,require('./components/EliminarReceta.vue').default);


//Componente para el boton de Like
  Vue.component('like-button' ,require('./components/LikeButton.vue').default);   
   

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});



//Owl-Carousel_______________________________________________________________________________________________________________
jQuery(document).ready(function(){
  jQuery('.owl-carousel').owlCarousel({
    
    margin: 10,    //Separacion de elementos en el carrusel
    loop: true,    //Cuando el carrusel acabe repitalo infinitamente
    autoplay: true,   //Para que se mueva automaticamente
    autoplayHoverPause: true,    //Para que deje de moverse cunado pongamos en cursor sobre algun elemento
    responsive:{
      0:{
        items:1
      },
      600:{
        items:2      //La herramienta 'responsive': Nos sirve en este caso para definir cuantos items mostrar dependiendo el disposiivo en el que se este navegando
      },
      1000:{
        items:3
      }
             }
  });  
});













