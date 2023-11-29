<script setup>

import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/vue3";
import Navbar from "@/Layouts/Navbar.vue";
import {computed, ref} from "vue";

const formOwner = useForm({
    name : '',
    last_name : '',
    telephone : '',
    RFC : ''
})

const RFCNotValidMessage = ref('')
const phoneNumberInvalidMessage = ref('')

const saveOwner = () => {
    /*const formData = formOwner.data()
    RFCNotValidMessage.value =  formData.RFC.length !== 13 ? 'Formato de RFC Inválido' : ''
    phoneNumberInvalidMessage.value = formData.telephone.length !== 10 ? 'Formato de Número telefónico inválido' : ''

    if (RFCNotValidMessage.value || phoneNumberInvalidMessage.value) {
        return null
    }*/

    formOwner.post(route('propietarios.store'),{})
}

const ableToSave = computed(() => {
    return !Object.values(formOwner.data()).some(field => !field)
})

</script>

<template>
    <Navbar>
        <div class="flex flex-col items-start justify-center w-full px-10 pt-5 pb-20 lg:pt-20 lg:flex-row">
            <div class="relative z-10 w-full max-w-2xl mt-20 lg:mt-0 lg:w-5/12">
                <div class="relative z-10 flex flex-col items-start justify-start p-10 bg-white shadow-2xl rounded-xl">
                    <h4 class="w-full text-4xl font-medium leading-snug text-sky-700">Agregar Propietario</h4>
                    <form @submit.prevent="saveOwner" class="relative w-full mt-6 space-y-8 text-black">
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
                            <InputError class="mt-2" :message="RFCNotValidMessage" />
                        </div>
                        <div class="relative">
                            <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Número telefónico</label>
                            <input v-model="formOwner.telephone" type="text" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresa un número telefónico de 10 dígitos">
                            <InputError class="mt-2" :message="phoneNumberInvalidMessage" />
                        </div>
                        <div class="relative">
                            <button :disabled="!ableToSave" :class="ableToSave ? 'bg-blue-600 hover:bg-blue-500' : 'bg-gray-400 hover:bg-gray-500'" class="inline-block w-full px-5 py-4 text-xl font-medium text-center text-white transition duration-200 rounded-lg ease">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Navbar>

</template>

<style scoped>

</style>
