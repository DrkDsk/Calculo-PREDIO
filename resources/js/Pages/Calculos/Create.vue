<script setup>

import {router, useForm} from "@inertiajs/vue3";
import {computed, ref} from "vue";
import Navbar from "@/Layouts/Navbar.vue";

const props = defineProps({
    ground : Object
})

const inpcActual    = ref(0)
const inpcDePago    = ref(0)
const importe       = ref(0)
const tasaRecargo   = ref(0)

const meses = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre"
]

const mesActual = meses[(new Date()).getMonth()];
const mesSeleccionado = ref('');
const formCalculation = useForm({
    inpcActual : 0,
    inpcDePago: 0,
    importe : 0,
    tasaDeRecargo : 0
})

const recargo = computed(() => {
  let inpcActual  = parseFloat(formCalculation.inpcActual)
  let inpcDePago  = parseFloat(formCalculation.inpcDePago)
  let importe     = round(parseFloat(formCalculation.importe))
  let tasaRecargo = parseFloat(formCalculation.tasaDeRecargo)
  let actualizacionPlusImporte = (importe * (inpcActual / inpcDePago))

  if (!importe || !inpcActual || !inpcDePago || !tasaRecargo) {
    return null;
  }

  return round(actualizacionPlusImporte * tasaRecargo)
})

const actualizacionTotal = computed(() => {
  let inpcActual  = parseFloat(formCalculation.inpcActual)
  let inpcDePago  = parseFloat(formCalculation.inpcDePago)
  let importe     = round(formCalculation.importe)

  if (!importe || !inpcActual || !inpcDePago) {
    return null;
  }

  let actualizacionPlusImporte = (importe * (inpcActual / inpcDePago))
  return round(actualizacionPlusImporte - importe)
})

const importarTotal = computed(() => {
    let inpcActual  = parseFloat(formCalculation.inpcActual)
    let inpcDePago  = parseFloat(formCalculation.inpcDePago)
    let importe     = round(parseFloat(formCalculation.importe))
    let tasaRecargo = parseFloat(formCalculation.tasaDeRecargo)
    let actualizacionPlusImporte = (importe * (inpcActual / inpcDePago))
    let actualizacion          = round(actualizacionPlusImporte - importe)

    if (!importe || !inpcActual || !inpcDePago || !tasaRecargo) {
      return null;
    }

    let recargo                = round(actualizacionPlusImporte * tasaRecargo)

    return round(importe + actualizacion + recargo)
})

const round = (number) => {
    const decimal = number % 1;

    if (decimal >= 0.5) {
        return Math.ceil(number);
    }

    return Math.floor(number);
}

const saveOperation = () => {
    router.post(route('terrenos.calculos.store', props.ground.id), {
        'ground_id'               : props.ground.id,
        'amount'                  : importe.value,
        'updated_charge'          : actualizacionTotal,
        'surcharge'               : recargo,
        'amount_to_pay'           : importarTotal,
        'month_at_operation_date' : mesActual,
        'month_of_pay'            : meses[mesSeleccionado.value-1],
        'INCP_at_operation_date'  : inpcActual.value,
        'INCP_applied'            : inpcDePago.value,
        'surcharge_rate'          : tasaRecargo.value
    })
}
</script>

<template>
    <Navbar>
        <div class="flex flex-col items-start justify-center w-full px-10 pt-5 pb-20 lg:pt-20 lg:flex-row">
            <div class="relative z-10 w-full max-w-2xl mt-20 lg:mt-0 lg:w-5/12">
                <div class="relative z-10 flex flex-col items-start justify-start p-10 bg-white shadow-2xl rounded-xl">
                    <h4 class="w-full text-4xl font-medium leading-snug text-sky-700">Realizar cálculo</h4>
                    <form class="relative w-full mt-6 space-y-8">
                        <div class="relative">
                            <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Mes del cálculo</label>
                            <select v-model="mesSeleccionado" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black">
                                <option selected>Selecciona el mes del cálculo</option>
                                <option value="1">Enero</option>
                                <option value="2">Febrero</option>
                                <option value="3">Marzo</option>
                                <option value="4">Abril</option>
                                <option value="5">Mayo</option>
                                <option value="6">Junio</option>
                                <option value="7">Julio</option>
                                <option value="8">Agosto</option>
                                <option value="9">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                        <div class="relative">
                            <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">INPC Actual ({{mesActual}})</label>
                            <input v-model="formCalculation.inpcActual" type="text" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresa la cantidad del INPC">
                        </div>
                        <div class="relative">
                            <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">INPC Correspondiente ({{meses[mesSeleccionado-1]}})</label>
                            <input v-model="formCalculation.inpcDePago" type="text" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresa la cantidad del INPC Correspondiente">
                        </div>
                        <div class="relative">
                            <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Importe</label>
                            <input v-model="formCalculation.importe" type="text" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresa el importe">
                        </div>
                        <div class="relative">
                            <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Tasa de Recargo</label>
                            <input v-model="formCalculation.tasaDeRecargo" type="text" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresa la tasa de recargo">
                        </div>
                        <div class="relative">
                            <button class="inline-block w-full px-5 py-4 text-xl font-medium text-center text-white transition duration-200 bg-blue-600 rounded-lg hover:bg-blue-500 ease">Calcular</button>
                        </div>
                    </form>
                </div>
            </div>
            <div v-if="importarTotal" class="ml-8 z-10 flex flex-col items-start justify-start p-10 bg-white shadow-2xl rounded-xl">
                <h4 class="w-full text-4xl font-medium leading-snug">Resultados:</h4>
                <h3 class="w-full text-xl font-medium leading-snug">Importe: <span class="text-yellow-600">{{ round(formCalculation.importe) }}</span></h3>
                <h3 class="w-full text-xl font-medium leading-snug">Actualización: <span class="text-blue-600">{{actualizacionTotal}}</span></h3>
                <h3 class="w-full text-xl font-medium leading-snug">Recargo: <span class="text-red-600">{{recargo}}</span></h3>
                <div class="linea-divisoria">
                    <h3 class="w-full text-xl font-medium leading-snug">Importe a Pagar: <span class="text-green-600">{{importarTotal}}</span></h3>
                </div>
                <div class="flex flex-row justify-end w-full mt-4">
                    <button v-on:click="saveOperation" class="text-white w-full rounded-full bg-emerald-600 px-3 py-2">
                        Guardar registro
                    </button>
                </div>
            </div>
        </div>
    </Navbar>
</template>

<style scoped>
.linea-divisoria {
    color: black;
    border-top: 2px solid black; /* Cambia el color y el grosor según lo desees */
    margin: 15px 0; /* Ajusta el margen para separar la línea de otros elementos */
}
</style>
