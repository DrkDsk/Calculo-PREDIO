<script setup>
import Navbar from "@/Layouts/Navbar.vue";
import Pagination from "@/Layouts/Pagination.vue";
import LinkButtonInfo3xl from "@/Components/LinkButtonInfo3xl.vue";

const props = defineProps({
    grounds : Object
})
</script>

<template>
    <Navbar>
        <div class="mt-3 w-full flex flex-col items-center">
            <div class="w-11/12 flex flex-col">
                <table v-if="grounds.data.length" class="w-full text-sm table-auto font-bold bg-cyan-900 rounded-lg">
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
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium flex flex-row gap-3">
                                    <LinkButtonInfo3xl :route-name="route('terrenos.calculos.create', ground.id)" title="Realizar cálculo">
                                    </LinkButtonInfo3xl>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div v-else class="bg-cyan-800 p-6 rounded-3xl text-white">
                    <p>Sin registros de terrenos</p>
                </div>
            </div>
            <pagination class="mt-6" :links="grounds.links"></pagination>
        </div>
    </Navbar>
</template>

<style scoped>

</style>
