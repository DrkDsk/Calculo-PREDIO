<script setup>

import {useForm} from "@inertiajs/vue3";
import Navbar from "@/Layouts/Navbar.vue";

const props = defineProps({
    owner : Object
})

const formGround = useForm({
    direction : '',
    grant_number : 0,
    square_meter : 0
})
const saveGround = () => {
    formGround.post(route('propietarios.terrenos.store', props.owner.id),{})
}

</script>

<template>
    <Navbar>
        <div class="flex flex-col items-start justify-center w-full px-10 lg:pt-6 lg:flex-row">
            <div class="relative w-full max-w-2xl mt-20 lg:mt-0 lg:w-8/12">
                <div class="relative flex flex-col items-start justify-start p-10 bg-white shadow-2xl rounded-xl">
                    <h4 class="w-full text-4xl font-medium leading-snug text-sky-700">Registrar Terreno</h4>
                    <form @submit.prevent="saveGround" class="relative w-full mt-6 space-y-8 text-black">
                        <div class="relative text-gray-400">
                            <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Nombre</label>
                            <input v-model="owner.name" readonly  type="text" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresa el nombre">
                        </div>
                        <div class="relative text-gray-400">
                            <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Apellidos</label>
                            <input v-model="owner.last_name" readonly type="text" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresas el apellido paterno y materno">
                        </div>
                        <div class="relative">
                            <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Dirección</label>
                            <input v-model="formGround.direction" type="text" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresa la dirección del terreno">
                        </div>
                        <div class="relative">
                            <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Número de concesión</label>
                            <input v-model="formGround.grant_number"  type="text" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresa el número de concesión">
                        </div>
                        <div class="relative">
                            <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Metros cuadrados</label>
                            <input v-model="formGround.square_meter"  type="text" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresa los metros cuadrados del terreno">
                        </div>
                        <div class="relative">
                            <button class="inline-block w-full px-5 py-4 text-xl font-medium text-center text-white transition duration-200 bg-blue-600 rounded-lg hover:bg-blue-500 ease">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Navbar>
</template>

<style scoped>

</style>
