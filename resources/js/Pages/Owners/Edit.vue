<script setup>
import {useForm} from "@inertiajs/vue3";
import Navbar from "@/Layouts/Navbar.vue";

let props = defineProps({
    owner : Object
})

const formOwner = useForm({
    _method: 'put',
    name : props.owner.name,
    last_name : props.owner.last_name,
    telephone : props.owner.telephone,
    RFC : props.owner.RFC
})

const updateOwner = () => {
    formOwner.post(route('propietarios.update', props.owner.id))
}

</script>

<template>
    <Navbar>
        <div class="flex flex-col items-start justify-center w-full px-10 pt-5 pb-20 lg:pt-20 lg:flex-row">
            <div class="relative z-10 w-full max-w-2xl mt-20 lg:mt-0 lg:w-5/12">
                <div class="relative z-10 flex flex-col items-start justify-start p-10 bg-white shadow-2xl rounded-xl">
                    <h4 class="w-full text-4xl font-medium leading-snug text-sky-700">Editar Propietario</h4>
                    <form method="post" @submit.prevent="updateOwner" class="relative w-full mt-6 space-y-8 text-black">
                        <div class="relative">
                            <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Nombre</label>
                            <input v-model="formOwner.name" type="text" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresa el nombre">
                        </div>
                        <div class="relative">
                            <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Apellidos</label>
                            <input v-model="formOwner.last_name" type="text" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresas el apellido paterno y materno">
                        </div>
                        <div class="relative">
                            <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">RFC</label>
                            <input v-model="formOwner.RFC" type="text" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresa el RFC">
                        </div>
                        <div class="relative">
                            <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Número telefónico</label>
                            <input v-model="formOwner.telephone" type="text" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresa un número telefónico de 10 dígitos">
                        </div>
                        <div class="relative">
                            <button type="submit" class="inline-block w-full px-5 py-4 text-xl font-medium text-center text-white transition duration-200 bg-blue-600 rounded-lg hover:bg-blue-500 ease">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Navbar>
</template>

<style scoped>

</style>
