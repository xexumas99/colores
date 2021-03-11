<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-4 text-center">
                <h1>Colores Page</h1>
                <img class="my-4" v-if="imagenSeleccionada != null" :src="imagenSeleccionada" alt="imagenSeleccionada" height="300" width="300">
                <label v-else class="my-4">Selecciona una imagen</label>
                <input type="file" @change="onFileSelected">
                <div v-if="rgb != null" class="col">
                    <div class="row my-2 bloque" :style='`background-color: rgb(${rgb.r}, ${rgb.g}, ${rgb.b})`'></div>
                    <label>{{nombre}}</label>                
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import axios from 'axios';

export default {

    data(){
        return  {
            imagenSeleccionada: null,
            rgb: null,
            nombre: null
        }
    },
    methods: {
        async onFileSelected(event){

            try {

                const file = event.target.files[0];
                this.imagenSeleccionada = URL.createObjectURL(file);

                let bodyFormData = new FormData();
                bodyFormData.append('imagen', file);

                const res = await axios.post(
                    '/color', 
                    bodyFormData, 
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'

                        }
                    }
                )
                const data = res.data

                this.rgb = {
                    r: data.r,
                    g: data.g,
                    b: data.b,
                }

                this.nombre = data.nombre
            } catch (error) {
                console.log(error.message)
            }
        }
    }
}
</script>

<style scoped>
    h1 {
        color: #343a40;
    }

    .bloque {
        display:block;
        height: 50px;
        width:100%;
    }
</style>