<script setup>
import Navbar from "@/Layouts/Navbar.vue";
import LinkButtonSuccess4xl from "@/Components/LinkButtonSuccess4xl.vue";
import LinkButtonInfo3xl from "@/Components/LinkButtonInfo3xl.vue";
import Pagination from "@/Layouts/Pagination.vue";

const props = defineProps({
    grounds : Object,
    owner   : Object
})

</script>

<template>
    <Navbar>
        <div class="mt-3 w-full flex flex-col items-center">
            <div class="flex flex-row justify-end my-4 w-full mr-8">
                <LinkButtonSuccess4xl :route-name="route('owners.grounds.create', owner.id)" title="Registrar propiedad">
                </LinkButtonSuccess4xl>
            </div>
            <div v-if="grounds.data.length" class="w-11/12 flex flex-col">
                <table class="w-full text-sm table-auto font-bold bg-cyan-900 rounded-lg">
                    <thead class="text-left uppercase">
                    <tr class="text-white">
                        <th scope="col" class="text-center py-4">No.</th>
                        <th scope="col" class="text-center py-4">Dirección</th>
                        <th scope="col" class="text-center py-4">Número de Concesión</th>
                        <th scope="col" class="text-center py-4">Metros cuadrados</th>
                        <th scope="col" class="text-center py-4">Tipo</th>
                        <th scope="col" class="text-center py-4">Propietario</th>
                        <th scope="col" class="text-center py-4">Cálculo INCP</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y-8 divide-gray-100 border-gray-100">
                    <tr v-for="ground in grounds.data" class="bg-white" style="border-radius: 10px">
                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium text-gray-700">
                                    {{ ground.id }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium text-gray-700">
                                    {{ ground.direction }}
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium text-gray-700">
                                    {{ ground.grant_number }}
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium text-gray-700">
                                    {{ ground.square_meter }}
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium text-gray-700">
                                    {{ ground.type }}
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium text-gray-700">
                                    {{ ground.owner.name }} {{ground.owner.last_name}}
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="text-sm py-2 px-4 text-center items-center mx-auto flex flex-row justify-center">
                                <div class="font-medium gap-3 flex flex-row justify-center w-full">
                                    <LinkButtonInfo3xl :route-name="route('grounds.balances.create', ground.id)" title="Realizar cálculo">
                                    </LinkButtonInfo3xl>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <pagination class="my-6 mx-auto" :links="grounds.links"></pagination>
            </div>
            <div v-else class="h-screen flex items-center justify-center">
                <div class="bg-cyan-800 p-6 rounded-lg text-7xl text-white font-semibold">
                    <p>Sin registros de propiedades</p>
                </div>
            </div>
        </div>
    </Navbar>
</template>

<style scoped>

</style>
