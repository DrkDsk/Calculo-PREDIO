<script setup>

import {router, useForm} from "@inertiajs/vue3";
import {computed} from "vue";

const props = defineProps({
    ground: Object,
    balance: Object,
    id: null,
    updateView: Boolean,
    titleButton: String,
    routeName: String,
    years: Object
})

const formCalculation = useForm({
    year_at_operation_date: props.balance?.year_at_operation_date ?? 0,
    due_payment_year: props.balance?.due_payment_year ?? 0,
    inpcActual: props.balance?.INCP_at_operation_date ?? 0,
    current_month: props.balance?.month_at_operation_date ?? 0,
    month_of_pay: props.balance?.month_of_pay ?? 0,
    inpcDePago: props.balance?.INCP_applied ?? 0,
    importe: props.balance?.amount ?? 0,
    tasaDeRecargo: props.balance?.surcharge_rate ?? 0
})

const recargo = computed(() => {
    let tasaRecargo = formCalculation.tasaDeRecargo / 100

    if (!tasaRecargo) {
        return 0;
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
        return 0;
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

const saveOperation = () => {
    let data = {
        'ground_id': props.ground.id,
        'amount': formCalculation.importe,
        'updated_charge': actualizacion.value,
        'surcharge': recargo.value,
        'year_at_operation_date' : formCalculation.year_at_operation_date,
        'due_payment_year' : formCalculation.due_payment_year,
        'amount_to_pay': importarTotal.value,
        'month_at_operation_date': formCalculation.current_month,
        'month_of_pay': formCalculation.month_of_pay,
        'INCP_at_operation_date': formCalculation.inpcActual,
        'INCP_applied': formCalculation.inpcDePago,
        'surcharge_rate': formCalculation.tasaDeRecargo,
    }

    router.post(route(props.routeName, props.id), data)
}
</script>

<template>
    <div class="flex flex-col items-start justify-center w-full lg:flex-row">
        <div class="relative z-10 w-full">
            <div class="relative z-10 flex flex-col items-start justify-start p-10 bg-white shadow-2xl rounded-xl">
                <h4 class="text-4xl font-medium leading-snug text-sky-700">Realizar cálculo</h4>
                <form class="relative mt-6 space-y-8 w-full">
                    <div class="relative">
                        <div v-if="updateView">
                            <div class="grid grid-cols-2 gap-3 space-y-3">
                                <div>
                                    <label class="absolute px-2 ml-2 -mt-3 bg-gray-100 rounded-md font-medium text-gray-600">
                                        Año del cálculo
                                    </label>
                                    <input disabled v-model="formCalculation.year_at_operation_date" type="text"
                                           class="bg-gray-100 block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black">
                                </div>

                                <div>
                                    <label class="absolute px-2 ml-2 -mt-3 bg-gray-100 rounded-md font-medium text-gray-600">
                                        Año en que se debió pagar
                                    </label>
                                    <input disabled v-model="formCalculation.due_payment_year" type="text"
                                           class="bg-gray-100 block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black">
                                </div>

                                <div>
                                    <label class="absolute px-2 ml-2 -mt-3 bg-gray-100 rounded-md font-medium text-gray-600">
                                        Mes del cálculo
                                    </label>
                                    <input disabled v-model="formCalculation.current_month" type="text"
                                           class="bg-gray-100 block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black">
                                </div>
                                <div>
                                    <label class="absolute px-2 ml-2 -mt-3 bg-gray-100 rounded-md font-medium text-gray-600">
                                        Mes que se debió pagar
                                    </label>
                                    <input disabled v-model="formCalculation.month_of_pay" type="text"
                                           class="bg-gray-100 block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black">
                                </div>
                            </div>
                        </div>
                        <div v-else class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="font-medium text-gray-600 bg-white">Año del cálculo</label>
                                <input :disabled="updateView" :class="updateView ? 'bg-gray-100' : 'bg-white'" v-model="formCalculation.year_at_operation_date" type="text"
                                       class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black"
                                       placeholder="Ingresa el año">
                            </div>

                            <div>
                                <label class="font-medium text-gray-600 bg-white">Año en que se debió pagar</label>
                                <input :disabled="updateView" :class="updateView ? 'bg-gray-100' : 'bg-white'" v-model="formCalculation.due_payment_year" type="text"
                                       class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black"
                                       placeholder="Ingresa el año">
                            </div>

                            <div>
                                <label class="font-medium text-gray-600 bg-white">Mes del cálculo</label>
                                <select v-model="formCalculation.current_month"
                                        class="w-full block px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black">
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

                            <div>
                                <label class="font-medium text-gray-600 bg-white">Mes que se debió pagar</label>
                                <select v-model="formCalculation.month_of_pay"
                                        class="w-full block px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black">
                                    <option selected>Selecciona el mes en que se debió pagar</option>
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
                    </div>
                    <div class="relative">
                        <label :class="updateView ? 'bg-gray-100' : 'bg-white'" class="rounded-md absolute px-2 ml-2 -mt-3 font-medium text-gray-600">INPC Actual
                            (Mes anterior al actual)</label>
                        <input :disabled="updateView" :class="updateView ? 'bg-gray-100' : 'bg-white'" v-model="formCalculation.inpcActual" type="text"
                               class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black"
                               placeholder="Ingresa la cantidad del INPC">
                    </div>
                    <div class="relative">
                        <label :class="updateView ? 'bg-gray-100' : 'bg-white'" class="rounded-md absolute px-2 ml-2 -mt-3 font-medium text-gray-600">INPC Correspondiente
                            (Mes que se debió pagar)</label>
                        <input :disabled="updateView" :class="updateView ? 'bg-gray-100' : 'bg-white'" v-model="formCalculation.inpcDePago" type="text"
                               class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black"
                               placeholder="Ingresa la cantidad del INPC Correspondiente">
                    </div>
                    <div class="relative">
                        <label :class="updateView ? 'bg-gray-100' : 'bg-white'" class="rounded-md absolute px-2 ml-2 -mt-3 font-medium text-gray-600">Importe</label>
                        <input :disabled="updateView" :class="updateView ? 'bg-gray-100' : 'bg-white'" v-model="formCalculation.importe" type="text"
                               class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black"
                               placeholder="Ingresa el importe">
                    </div>
                    <div class="relative">
                        <label :class="updateView ? 'bg-gray-100' : 'bg-white'" class="rounded-md absolute px-2 ml-2 -mt-3 font-medium text-gray-600">Tasa de
                            Recargo</label>
                        <input :disabled="updateView" :class="updateView ? 'bg-gray-100' : 'bg-white'" v-model="formCalculation.tasaDeRecargo" type="text"
                               class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black"
                               placeholder="Ingresa la tasa de recargo">
                    </div>
                </form>
            </div>
        </div>
        <div class="ml-8 z-10 flex flex-col items-start justify-start p-10 bg-white shadow-2xl rounded-xl">
            <h4 class="w-full text-4xl font-medium leading-snug">Resultados:</h4>
            <h3 class="w-full text-xl font-medium leading-snug">Importe: <span
                class="text-yellow-600">${{round(formCalculation.importe)}}</span></h3>
            <h3 class="w-full text-xl font-medium leading-snug">Actualización: <span
                class="text-blue-600">${{actualizacion}}</span></h3>
            <h3 class="w-full text-xl font-medium leading-snug">Recargo: <span class="text-red-600">${{recargo}}</span>
            </h3>
            <div class="linea-divisoria">
                <h3 class="w-full text-xl font-medium leading-snug">Importe a Pagar: <span
                    class="text-green-600">${{importarTotal}}</span></h3>
            </div>
            <div v-if="importarTotal && titleButton" class="flex flex-row justify-end w-full mt-4">
                <button v-on:click="saveOperation" class="text-white w-full rounded-full bg-emerald-600 px-3 py-2">
                    {{ titleButton }}
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
