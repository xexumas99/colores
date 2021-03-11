<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-4 text-center">
                <h1>Colores Page</h1>
                <img class="my-4" v-if="imagenSeleccionada != null" :src="imagenSeleccionada" alt="imagenSeleccionada" height="300" width="300">
                <label v-else class="my-4">Selecciona una imagen</label>
                <input type="file" @change="onFileSelected">
            </div>
        </div>
    </div>
</template>

<script>

export default {

    data(){
        return  {
            imagenSeleccionada: null,
        }
    },
    methods: {
        onFileSelected(event){
            const file = event.target.files[0];
            this.imagenSeleccionada = URL.createObjectURL(file);
        }
    }
}
</script>

<style scoped>
    h1 {
        color: #343a40;
    }
</style>