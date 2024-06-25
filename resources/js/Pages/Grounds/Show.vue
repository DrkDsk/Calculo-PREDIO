<script setup>

import Navbar from "@/Layouts/Navbar.vue";
import ButtonDelete3xl from "@/Components/ButtonDelete3xl.vue";
import LinkButton3xl from "@/Components/LinkButton3xl.vue";
import {deleteCalculo} from "@/utils/handleDeleteService.js";
import Pagination from "@/Layouts/Pagination.vue";

const props = defineProps({
    ground: Object,
    balances: Object
})

const ground = props.ground.data
const balances = props.balances.data
const links = props.balances

const handleDeleteCalculo = (balance_id) => {
    deleteCalculo(balance_id)
}

</script>

<template>
    <Navbar>
        <div class="mt-3 w-full flex flex-col items-center">
            <div class="flex flex-col w-full lg:pt-6 lg:flex-row justify-center">
                <div class="relative w-full max-w-2xl mt-20 lg:mt-0 lg:w-8/12">
                    <div class="relative flex flex-col items-start justify-start p-10 bg-white shadow-2xl rounded-xl">
                        <h4 class="w-full text-4xl font-medium leading-snug text-sky-700">Propiedad</h4>
                        <form class="relative w-full mt-6 space-y-8 text-black">
                            <div class="relative">
                                <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Dirección</label>
                                <input v-model="ground.direction" readonly disabled type="text" class="text-gray-400 block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresa la dirección del terreno">
                            </div>
                            <div class="relative">
                                <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Número de concesión</label>
                                <input v-model="ground.grant_number" readonly disabled type="text" class="text-gray-400 block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresa el número de concesión">
                            </div>
                            <div class="relative">
                                <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Metros cuadrados</label>
                                <input v-model="ground.square_meter"  type="text" class="text-gray-400 block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresa los metros cuadrados del terreno">
                            </div>
                            <div class="relative">
                                <label class="absolute px-2 ml-2 -mt-3 font-medium text-gray-600 bg-white">Tipo de propiedad</label>
                                <input v-model="ground.type" type="text" class="text-gray-400 block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-black" placeholder="Ingresa los metros cuadrados del terreno">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div v-if="balances.length" class="mt-4 w-11/12 flex flex-col items-end">
                <table class="w-full text-sm table-auto font-bold bg-cyan-900 rounded-lg">
                    <thead class="text-left uppercase">
                    <tr class="text-white">
                        <th scope="col" class="text-center py-4">Importe</th>
                        <th scope="col" class="text-center py-4 px-4">Actualización</th>
                        <th scope="col" class="text-center py-4 px-4">Recargo</th>
                        <th scope="col" class="text-center py-4 px-4">Total</th>
                        <th scope="col" class="text-center py-4">Opciones</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y-8 divide-gray-100 border-gray-100">
                    <tr v-for="balance in balances" class="bg-white" style="border-radius: 10px">

                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium text-gray-700">
                                    ${{ balance.amount }}
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium text-gray-700">
                                    ${{ balance.updated_charge }}
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium text-gray-700">
                                    ${{ balance.surcharge }}
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium text-gray-700">
                                    ${{ balance.amount_to_pay }}
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium gap-4 flex flex-row justify-center">
                                    <LinkButton3xl :route-name="route('balances.show', balance.id)" title="Ver cálculo">
                                    </LinkButton3xl>

                                    <ButtonDelete3xl class="text-white px-3 py-2 bg-red-500 rounded-3xl" title="Eliminar cálculo" @delete="handleDeleteCalculo(balance.id)">
                                    </ButtonDelete3xl>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <pagination class="my-6" :links="links"></pagination>
            </div>
            <div v-else class="bg-cyan-800 p-6 rounded-3xl text-white">
                <p>Sin registros de cálculos</p>
            </div>
        </div>
    </Navbar>
</template>

<style scoped>

</style>
