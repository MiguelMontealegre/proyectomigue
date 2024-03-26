//Todo lo que este dentro de template va a ser visible a el usuario , este se vera cuando el usuario use la etiqueta de este componente
<!--  Mirar video 82° -->

<template>
    <span v-text="formatearFecha"></span>    <!-- Esto es lo mismo que tener:  <span> {{formatearFecha}} </span>   -->
</template>

<!--_____________________________________________________________________________-->

<script>
export default {

props: ['fecha'],

/*    mounted() {
      console.log("La fecha es: ", this.fecha);
    },  */

    computed: {
        formatearFecha() {

             return moment(this.fecha).locale('es').format('DD [de] MMMM [del] YYYY')
        }
    }
};
</script>
