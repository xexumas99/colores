<template>
    <div class="view pt-5" :style="rgb != null ? `background-color: rgb(${rgb.r}, ${rgb.g}, ${rgb.b})` : ''">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col text-center">
                    <div class="card bg-dark mb-3">
                        <div class="card-header">
                            <h1>Colores</h1>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <img class="my-4" v-if="imagenSeleccionada != null" :src="imagenSeleccionada" alt="imagenSeleccionada" height="300" width="300">
                                    <h3 v-else class="my-4">Selecciona una imagen</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="file" @change="onFileSelected">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <h2 v-if="rgb != null" :style="`color: rgb(${rgb.r}, ${rgb.g}, ${rgb.b})`">
                                        <strong>{{nombre}}</strong>
                                    </h2>
                                </div>
                            </div>
                            <div class="row mt-3 justify-content-center mb-3" v-if="rgb != null">
                                <div  v-for="(c, index) in complementarios" :key="index" class="bloque mx-2" :style="`background-color: rgb(${c.r}, ${c.g}, ${c.b})`"></div>
                            </div>
                        </div>
                    </div> 
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
            nombre: null,
            complementarios: []
        }
    },
    methods: {
        async onFileSelected(event){

            try {

                const file = event.target.files[0];

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

                this.complementarios = data.complementarios

                this.imagenSeleccionada = URL.createObjectURL(file);

            } catch (error) {
                const res = error.response
                const data = res.data

                this.imagenSeleccionada = null,
                this.rgb = null,
                this.nombre = null,
                this.complementarios = []

                alert(data.mensaje)
            }
        }
    }
}
</script>

<style scoped>

    .bloque {
        display:block;
        height: 50px;
        width: 50px;
    }

    .view {
        color: white;
    }
</style>