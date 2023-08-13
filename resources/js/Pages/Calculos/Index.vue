<script setup>

import {Link} from "@inertiajs/vue3";
import Navbar from "@/Layouts/Navbar.vue";
import Pagination from "@/Layouts/Pagination.vue";

const props = defineProps({
    balances : Object
})
</script>

<template>
    <Navbar>
        <div class="mt-3 w-full flex flex-col items-center">
            <table v-if="balances.data.length" class="w-11/12 text-sm table-auto font-bold bg-cyan-900 rounded-lg">
                <thead class="text-left uppercase">
                <tr class="text-white">
                    <th scope="col" class="text-center py-4 pl-3">Concesión</th>
                    <th scope="col" class="text-center py-4">RFC</th>
                    <th scope="col" class="text-center py-4">Importe</th>
                    <th scope="col" class="text-center py-4 px-4">Actualización</th>
                    <th scope="col" class="text-center py-4 px-4">Recargo</th>
                    <th scope="col" class="text-center py-4 px-4">Total</th>
                    <th scope="col" class="text-center py-4">Mes</th>
                    <th scope="col" class="text-center py-4">Mes de cálculo</th>
                    <th scope="col" class="text-center py-4">INCP del mes de operación</th>
                    <th scope="col" class="text-center py-4">INCP del mes aplicado</th>
                    <th scope="col" class="text-center py-4">Tasa de recargo</th>
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
                            <div class="font-medium text-gray-700">
                                {{ balance.month_at_operation_date }}
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="text-sm py-2 px-4 text-center">
                            <div class="font-medium text-gray-700">
                                {{ balance.month_of_pay }}
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="text-sm py-2 px-4 text-center">
                            <div class="font-medium text-gray-700">
                                ${{ balance.INCP_at_operation_date }}
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="text-sm py-2 px-4 text-center">
                            <div class="font-medium text-gray-700">
                                ${{ balance.INCP_applied }}
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="text-sm py-2 px-4 text-center">
                            <div class="font-medium text-gray-700">
                                ${{ balance.surcharge_rate }}
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="text-sm py-2 px-4 text-center">
                            <div class="font-medium">
                                <Link class="text-blue-500" :href="route('balances.show', balance.id)">
                                    Ver cálculo
                                </Link>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <div v-else class="bg-cyan-800 p-6 rounded-3xl text-white">
                <p>Sin registros de cálculos</p>
            </div>
            <pagination class="mt-6" :links="balances.links"></pagination>
        </div>
    </Navbar>
</template>

<style scoped>

</style>
