<script setup>

import {router, useForm} from "@inertiajs/vue3";
import {computed, ref} from "vue";

const props = defineProps({
    ground: Object,
    balance: Object,
    id: null,
    updateView: Boolean,
    titleButton: String,
    routeName: String
})

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
let mesSeleccionado = ref('');
let inpcMesCorrespondiente = ref('')

if (props.updateView) {
    mesSeleccionado.value = props.balance.month_of_pay
    inpcMesCorrespondiente.value = mesSeleccionado.value
}

const formCalculation = useForm({
    inpcActual: props.balance?.INCP_at_operation_date ?? 0,
    inpcDePago: props.balance?.INCP_applied ?? 0,
    importe: props.balance?.amount ?? 0,
    tasaDeRecargo: props.balance?.surcharge_rate ?? 0
})

const recargo = computed(() => {
    let tasaRecargo = formCalculation.tasaDeRecargo

    if (!tasaRecargo) {
        return null;
    }

    return round(actualizacionPlusImporte() * tasaRecargo)
})

const actualizacionPlusImporte = () => {
    let inpcActual = formCalculation.inpcActual
    let inpcDePago = formCalculation.inpcDePago
    let importe = round(formCalculation.importe)

    if (!importe || !inpcActual || !inpcDePago) {
        return null;
    }

    return (importe * (inpcActual / inpcDePago))
}

const actualizacion = computed(() => {
    return round(actualizacionPlusImporte() - round(formCalculation.importe))
})

const importarTotal = computed(() => {
    let importe = round(formCalculation.importe)

    if (!importe || !actualizacion.value || !recargo.value) {
        return null;
    }

    return round(importe + actualizacion.value + recargo.value)
})

const round = (number) => {
    const decimal = number % 1;

    if (decimal >= 0.5) {
        return Math.ceil(number);
    }

    return Math.floor(number);
}

const updateMesInpcCorrespondiente = () => {
    inpcMesCorrespondiente.value = meses[ mesSeleccionado.value - 1]
}

const saveOperation = () => {
    let data = {
        'ground_id': props.ground.id,
        'amount': formCalculation.importe,
        'updated_charge': actualizacion.value,
        'surcharge': recargo.value,
        'amount_to_pay': importarTotal.value,
        'month_at_operation_date': mesActual,
        'month_of_pay': inpcMesCorrespondiente.value,
        'INCP_at_operation_date': formCalculation.inpcActual,
        'INCP_applied': formCalculation.inpcDePago,
        'surcharge_rate': formCalculation.tasaDeRecargo
    }

    router.post(route(props.routeName, props.id), data)
}
</script>

<template>
    <div class="flex flex-col items-start justify-center w-full px-10 pt-5 pb-20 lg:pt-20 lg:flex-row">
        <div class="relative z-10 w-full max-w-2xl mt-20 lg:mt-0 lg:w-5/12">
            <div class="relative z-10 flex flex-col items-start justify-start p-10 bg-white shadow-2xl rounded-xl">
                <h4 class="w-full text-4xl font-medium leading-snug text-sky-700">Realizar cálculo</h4>
                <form class="relative w-full mt-6 space-y-8">
                    <div class="relative">
                        <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Mes del
                            cálculo</label>
                        <div v-if="updateView" >
                            <select v-model="mesSeleccionado"
                                    class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black">
                                <option selected>{{balance.month_of_pay}}</option>
                            </select>
                        </div>
                        <div v-else>
                            <select v-on:change="updateMesInpcCorrespondiente" v-model="mesSeleccionado"
                                    class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black">
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
                    </div>
                    <div class="relative">
                        <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">INPC Actual
                            ({{ mesActual }})</label>
                        <input v-model="formCalculation.inpcActual" type="text"
                               class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black"
                               placeholder="Ingresa la cantidad del INPC">
                    </div>
                    <div class="relative">
                        <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">INPC Correspondiente
                            ({{ inpcMesCorrespondiente }})</label>
                        <input v-model="formCalculation.inpcDePago" type="text"
                               class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black"
                               placeholder="Ingresa la cantidad del INPC Correspondiente">
                    </div>
                    <div class="relative">
                        <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Importe</label>
                        <input v-model="formCalculation.importe" type="text"
                               class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black"
                               placeholder="Ingresa el importe">
                    </div>
                    <div class="relative">
                        <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Tasa de
                            Recargo</label>
                        <input v-model="formCalculation.tasaDeRecargo" type="text"
                               class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black"
                               placeholder="Ingresa la tasa de recargo">
                    </div>
                </form>
            </div>
        </div>
        <div class="ml-8 z-10 flex flex-col items-start justify-start p-10 bg-white shadow-2xl rounded-xl">
            <h4 class="w-full text-4xl font-medium leading-snug">Resultados:</h4>
            <h3 class="w-full text-xl font-medium leading-snug">Importe: <span
                class="text-yellow-600">{{ round(formCalculation.importe) }}</span></h3>
            <h3 class="w-full text-xl font-medium leading-snug">Actualización: <span
                class="text-blue-600">{{ actualizacion }}</span></h3>
            <h3 class="w-full text-xl font-medium leading-snug">Recargo: <span class="text-red-600">{{ recargo }}</span>
            </h3>
            <div class="linea-divisoria">
                <h3 class="w-full text-xl font-medium leading-snug">Importe a Pagar: <span
                    class="text-green-600">{{ importarTotal }}</span></h3>
            </div>
            <div v-if="titleButton" class="flex flex-row justify-end w-full mt-4">
                <button v-on:click="saveOperation" class="text-white w-full rounded-full bg-emerald-600 px-3 py-2">
                    {{ titleButton }}
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
