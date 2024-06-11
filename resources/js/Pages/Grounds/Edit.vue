<script setup>

import {useForm} from "@inertiajs/vue3";
import Navbar from "@/Layouts/Navbar.vue";
import SubmitButton from "@/Components/SubmitButton.vue";

const props = defineProps({
    ground : Object,
    owner: Object,
    types: Object
})

const formGround = useForm({
    _method: 'put',
    direction : props.ground.direction,
    grant_number : props.ground.grant_number,
    square_meter : props.ground.square_meter,
    type: props.ground.type,
    years: props.ground.years,
})
const updateGround = () => {
    formGround.post(route('terrenos.update', props.ground.id),{})
}

</script>

<template>
    <Navbar>
        <div class="flex flex-col items-start justify-center w-full px-10 lg:pt-6 lg:flex-row">
            <div class="relative w-full max-w-2xl mt-20 lg:mt-0 lg:w-8/12">
                <div class="relative flex flex-col items-start justify-start p-10 bg-white shadow-2xl rounded-xl">
                    <h4 class="w-full text-4xl font-medium leading-snug text-sky-700">Editar Propiedad</h4>
                    <form @submit.prevent="updateGround" class="relative w-full mt-6 space-y-8 text-black">
                        <div class="relative text-gray-400">
                            <label class="absolute px-2 ml-2 -mt-3 font-medium bg-white">Nombre</label>
                            <input v-model="owner.name" readonly  type="text" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresa el nombre">
                        </div>
                        <div class="relative text-gray-400">
                            <label class="absolute px-2 ml-2 -mt-3 font-medium bg-white">Apellidos</label>
                            <input v-model="owner.name" readonly type="text" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresas el apellido paterno y materno">
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
                            <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Tipo de propiedad</label>
                            <select v-model="formGround.type" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black">
                                <option :value="type" v-for="type of types">
                                    {{type}}
                                </option>
                            </select>
                        </div>
                        <div class="relative">
                            <SubmitButton title="Actualizar"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Navbar>
</template>

<style scoped>

</style>
