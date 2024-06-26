<script setup>

import Navbar from "@/Layouts/Navbar.vue";

const props = defineProps({
    ground: Object,
    balance: Object
})

const round = (number) => {
    const decimal = number % 1;

    if (decimal >= 0.5) {
        return Math.ceil(number);
    }

    return Math.floor(number);
}

</script>

<template>
    <Navbar>
        <div class="w-11/12 mx-auto mt-10">
            <div class="flex flex-col items-start justify-center w-full lg:flex-row space-x-3">
                <div class="relative z-10 w-9/12">
                    <div class="relative z-10 flex flex-col items-start justify-start p-10 bg-white shadow-2xl rounded-xl">
                        <h4 class="text-4xl font-medium leading-snug text-sky-700">Cálculo</h4>
                        <form class="relative mt-6 space-y-8 w-full">
                            <div class="relative">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="my-4">
                                        <label class="absolute px-2 ml-2 -mt-3 bg-gray-100 rounded-md font-medium text-gray-600">
                                            Año del cálculo
                                        </label>
                                        <input disabled readonly  v-model="balance.year_at_operation_date" type="text"
                                               class="bg-gray-100 block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black">
                                    </div>

                                    <div class="my-4">
                                        <label class="absolute px-2 ml-2 -mt-3 bg-gray-100 rounded-md font-medium text-gray-600">
                                            Año en que se debió pagar
                                        </label>
                                        <input disabled readonly  v-model="balance.due_payment_year" type="text"
                                               class="bg-gray-100 block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black">
                                    </div>

                                    <div class="my-4">
                                        <label class="absolute px-2 ml-2 -mt-3 bg-gray-100 rounded-md font-medium text-gray-600">
                                            Mes del cálculo
                                        </label>
                                        <input disabled readonly v-model="balance.month_at_operation_date" type="text"
                                               class="bg-gray-100 block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black">
                                    </div>

                                    <div class="my-4">
                                        <label class="absolute px-2 ml-2 -mt-3 bg-gray-100 rounded-md font-medium text-gray-600">
                                            Mes que se debió pagar
                                        </label>
                                        <input disabled v-model="balance.month_of_pay" type="text"
                                               class="bg-gray-100 block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black">
                                    </div>

                                    <div class="my-4">
                                        <label class="rounded-md absolute px-2 ml-2 -mt-3 font-medium text-gray-600">
                                            INPC Actual (Mes anterior al actual)
                                        </label>
                                        <input disabled readonly  v-model="balance.INCP_at_operation_date" type="text"
                                               class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black"
                                               placeholder="Ingresa la cantidad del INPC">
                                    </div>

                                    <div class="my-4">
                                        <label class="rounded-md absolute px-2 ml-2 -mt-3 font-medium text-gray-600">INPC Correspondiente
                                            (Mes que se debió pagar)</label>
                                        <input disabled readonly v-model="balance.INCP_applied" type="text"
                                               class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black"
                                               placeholder="Ingresa la cantidad del INPC Correspondiente">
                                    </div>

                                    <div class="relative">
                                        <label class="rounded-md absolute px-2 ml-2 -mt-3 font-medium text-gray-600">Importe</label>
                                        <input disabled readonly v-model="balance.amount" type="text"
                                               class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black"
                                               placeholder="Ingresa el importe">
                                    </div>

                                    <div class="relative">
                                        <label class="rounded-md absolute px-2 ml-2 -mt-3 font-medium text-gray-600">Tasa de
                                            Recargo</label>
                                        <input disabled readonly v-model="balance.surcharge_rate" type="text"
                                               class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black"
                                               placeholder="Ingresa la tasa de recargo">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="z-10 flex flex-col items-start justify-start p-10 bg-white shadow-2xl rounded-xl">
                    <h4 class="w-full text-4xl font-medium leading-snug">Resultados:</h4>
                    <h3 class="w-full text-xl font-medium leading-snug">Importe: <span
                        class="text-yellow-600">${{round(balance.amount)}}</span></h3>
                    <h3 class="w-full text-xl font-medium leading-snug">Actualización: <span
                        class="text-blue-600">${{balance.updated_charge}}</span></h3>
                    <h3 class="w-full text-xl font-medium leading-snug">Recargo: <span class="text-red-600">${{balance.surcharge}}</span>
                    </h3>
                    <div class="linea-divisoria">
                        <h3 class="w-full text-xl font-medium leading-snug">Importe a Pagar: <span
                            class="text-green-600">${{balance.amount_to_pay}}</span></h3>
                    </div>
                </div>
            </div>
        </div>
    </Navbar>
</template>

<style scoped>

</style>
