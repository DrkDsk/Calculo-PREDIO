<script setup>

import Navbar from "@/Layouts/Navbar.vue";
import {useForm} from "@inertiajs/vue3";
import {computed} from "vue";
import TasaRecargoIndexComponent from "@/Pages/TasaRecargos/TasaRecargoIndexComponent.vue";

const props = defineProps({
    federalSurcharges: Object
})

const formSurcharge = useForm({
    year : '',
    value : ''
})

const saveSurchargeRate = () => {
    formSurcharge.post(route('surcharge.store'), {
        onFinish: () => {
            location.reload()
        }
    })
}

const ableToSave = computed(() => {
    const yearValid = formSurcharge.data().year
    const valueValid = formSurcharge.data().value

    return !!(yearValid && valueValid);
})

</script>

<template>
   <Navbar>
       <div class="flex flex-col items-start justify-center w-full px-10 lg:pt-20 lg:flex-row">
           <div class="relative z-10 w-full max-w-2xl mt-20 lg:mt-0 lg:w-5/12">
               <div class="relative z-10 flex flex-col items-start justify-start p-10 bg-white shadow-2xl rounded-xl">
                   <h4 class="w-full text-4xl font-medium leading-snug text-sky-700">Agregar Tasa de Recargo</h4>
                   <form @submit.prevent="saveSurchargeRate" class="relative w-full mt-6 space-y-8 text-black">
                       <div class="relative">
                           <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Año</label>
                           <input v-model="formSurcharge.year" type="text" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresa el año de la tasa de recargo">
                       </div>
                       <div class="relative">
                           <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Valor</label>
                           <input v-model="formSurcharge.value" type="text" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresas el apellido paterno y materno">
                       </div>
                       <div class="relative">
                           <button :disabled="!ableToSave" :class="ableToSave ? 'bg-blue-600 hover:bg-blue-500' : 'bg-gray-400 hover:bg-gray-500'" class="inline-block w-full px-5 py-4 text-xl font-medium text-center text-white transition duration-200 rounded-lg ease">Guardar</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
       <div class="mb-4">
           <TasaRecargoIndexComponent :federal-surcharges="federalSurcharges"></TasaRecargoIndexComponent>
       </div>
   </Navbar>
</template>

<style scoped>

</style>
