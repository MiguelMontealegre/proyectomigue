<template>
    <input 
        type="submit" 
        class="btn btn-danger d-block w-100 mb-2" 
        value="Eliminar ×"
        v-on:
        @click="eliminarReceta"
    >
    <!--Ese atributo de: v-on va a esperar a que suceda un click , tmbien serviria  @click=""  -->

</template>


<!------------------------------------- -->

<script>
    export default {
        props: ['recetaId'],
        methods: {
            eliminarReceta(){
                    this.$swal({
                        title: '¿Deseas eliminar esta receta?',
                        text: "Una vez eliminada, no se puede recuperar",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.value) {
                            const params = {
                                id: this.recetaId
                            }

                            // Enviar la petición al servidor
                            axios.post(`/recetas/${this.recetaId}`, {params, _method: 'delete'}) //En est parte de 'params' especificamos que estamos trabajando con delete , se hace de esa forma
                                .then(respuesta => {
                                    this.$swal({
                                        title: 'Receta Eliminada',
                                        text: 'Se eliminó la receta',
                                        icon: 'success'
                                    });

                                    // Eliminar receta del DOM (quitarla de las recetas que se pueden ver)
                                    // "el.parent.Node" Es para acceder a el padre de un elemento , en este caso:  input -> td -> tr  ... como pudimos ver la idea es acceder y eliminar el elemento padre principal que seria el "tr"
                                    this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);

                                })
                                .catch(error => {
                                    console.log(error)
                                })
                        }
                    })
            }
        }
    }

</script>



