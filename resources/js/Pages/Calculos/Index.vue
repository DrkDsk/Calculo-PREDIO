<script setup>

import Navbar from "@/Layouts/Navbar.vue";
import Pagination from "@/Layouts/Pagination.vue";
import {deleteCalculo} from '@/utils/handleDeleteService.js'
import LinkButton3xl from "@/Components/LinkButton3xl.vue";
import ButtonDelete3xl from "@/Components/ButtonDelete3xl.vue";

const props = defineProps({
    balances: Object
})

const handleDeleteCalculo = (balance_id) => {
    deleteCalculo(balance_id)
}

</script>

<template>
    <Navbar>
        <div class="mt-3 w-full flex flex-col items-center">
            <div class="w-11/12 flex flex-col">
                <table v-if="balances.data.length" class="w-full text-sm table-auto font-bold bg-cyan-900 rounded-lg">
                    <thead class="text-left uppercase">
                    <tr class="text-white">
                        <th scope="col" class="text-center py-4 pl-3">Concesión</th>
                        <th scope="col" class="text-center py-4">RFC</th>
                        <th scope="col" class="text-center py-4">Importe</th>
                        <th scope="col" class="text-center py-4 px-4">Actualización</th>
                        <th scope="col" class="text-center py-4 px-4">Recargo</th>
                        <th scope="col" class="text-center py-4 px-4">Total</th>
                        <th scope="col" class="text-center py-4">Ver</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y-8 divide-gray-100 border-gray-100">
                    <tr v-for="balance in balances.data" class="bg-white" style="border-radius: 10px">
                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium text-gray-700">
                                    {{ balance.ground.grant_number }}
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium text-gray-700">
                                    {{ balance.ground.owner.RFC }}
                                </div>
                            </div>
                        </td>

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
                <div v-else class="bg-cyan-800 p-6 rounded-3xl text-white">
                    <p>Sin registros de cálculos</p>
                </div>
            </div>
            <pagination class="mt-6" :links="balances"></pagination>
        </div>
    </Navbar>
</template>

<style scoped>

</style>
