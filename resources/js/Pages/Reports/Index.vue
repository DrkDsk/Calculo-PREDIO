<script setup>

import Navbar from "@/Layouts/Navbar.vue";
import {useForm} from "@inertiajs/vue3";
import SubmitButton from "@/Components/SubmitButton.vue";
import BalanceReportCardItem from "@/Components/BalanceReportCardItem.vue";

const props = defineProps({
    balances : Object,
    request: Object
})

const formCalculation = useForm({
    due_payment_year: props.request.due_payment_year ?? null,
    month_at_operation_date: props.request.month_at_operation_date ?? null
})

const handleSubmit = () => {
    formCalculation.get(route('reports.index'),)
}

</script>

<template>
    <Navbar>
        <div class="relative h-screen flex justify-center py-12 px-4 sm:px-6 lg:px-8 items-center">
            <div class="flex flex-col w-8/12 space-y-8">
                <form @submit.prevent="handleSubmit" class="relative mt-6 space-y-8 w-full bg-white p-8 rounded-md">
                    <div>
                        <label class="rounded-md -mt-3 font-medium text-gray-600">Año en que pagaron</label>
                        <input v-model="formCalculation.due_payment_year" type="text"
                               class="bg-white block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black"
                               placeholder="Ingresa el año">
                    </div>
                    <div>
                        <label class="rounded-md -mt-3 font-medium text-gray-600">Mes que pagaron</label>
                        <select v-model="formCalculation.month_at_operation_date"
                                class="w-full block px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black">
                            <option selected>Selecciona el mes</option>
                            <option value="Enero">Enero</option>
                            <option value="Febrero">Febrero</option>
                            <option value="Marzo">Marzo</option>
                            <option value="Abril">Abril</option>
                            <option value="Mayo">Mayo</option>
                            <option value="Junio">Junio</option>
                            <option value="Julio">Julio</option>
                            <option value="Agosto">Agosto</option>
                            <option value="Septiembre">Septiembre</option>
                            <option value="Octubre">Octubre</option>
                            <option value="Noviembre">Noviembre</option>
                            <option value="Diciembre">Diciembre</option>
                        </select>
                    </div>
                    <div class="flex flex-row justify-end">
                        <SubmitButton title="Filtrar"/>
                    </div>
                </form>
                <div class="grid grid-cols-3 gap-3 rounded-md" v-if="balances.length">
                    <BalanceReportCardItem v-for="balance in balances" :label="balance.label" :value="balance.value"/>
                </div>
            </div>
        </div>
    </Navbar>
</template>

<style scoped>

</style>
