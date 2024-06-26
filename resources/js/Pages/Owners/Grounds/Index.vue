<script setup>
import Navbar from "@/Layouts/Navbar.vue";
import LinkButtonSuccess4xl from "@/Components/LinkButtonSuccess4xl.vue";
import LinkButtonInfo3xl from "@/Components/LinkButton3xl.vue";
import Pagination from "@/Layouts/Pagination.vue";
import LinkButton3xl from "@/Components/LinkButton3xl.vue";
import ButtonDelete3xl from "@/Components/ButtonDelete3xl.vue";
import {deleteGround} from "@/utils/handleDeleteService.js";

const handleDeleteGround = (owner_id) => {
    deleteGround(owner_id)
}

const props = defineProps({
    grounds : Object,
    owner   : Object
})

</script>

<template>
    <Navbar>
        <div class="mt-3 w-full flex flex-col items-center">
            <div class="w-11/12 flex flex-col">
                <div class="flex justify-end my-4">
                    <LinkButtonSuccess4xl :route-name="route('owners.grounds.create', owner.id)" title="Registrar propiedad">
                    </LinkButtonSuccess4xl>
                </div>
                <div v-if="grounds.data.length" class="w-full flex flex-col items-end">
                    <table class="w-full text-sm table-auto font-bold bg-cyan-900 rounded-lg">
                        <thead class="text-left uppercase">
                        <tr class="text-white">
                            <th scope="col" class="text-center py-4">No.</th>
                            <th scope="col" class="text-center py-4">Dirección</th>
                            <th scope="col" class="text-center py-4">Número de Concesión</th>
                            <th scope="col" class="text-center py-4">Metros cuadrados</th>
                            <th scope="col" class="text-center py-4">Tipo</th>
                            <th scope="col" class="text-center py-4">Opciones</th>
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
                                    <div class="font-medium" :class="ground.grant_number ? 'text-gray-700' : 'text-red-600'">
                                        {{ ground.grant_number  ?? "Sin número de Concesión"}}
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
                                <div class="text-sm py-2 text-center items-center flex flex-row justify-center">
                                    <div class="font-medium gap-3 flex flex-row justify-center w-full">
                                        <LinkButtonInfo3xl :route-name="route('grounds.balances.create', ground.id)" title="realizar cálculo"/>
                                        <LinkButton3xl :route-name="route('grounds.edit', ground.id)" title="Editar"/>
                                        <ButtonDelete3xl @delete="handleDeleteGround(ground.id)" title="Eliminar"/>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <pagination class="my-6 mx-auto" :links="grounds"></pagination>
                </div>
                <div v-else class="h-screen flex items-center justify-center">
                    <div class="bg-cyan-800 p-6 rounded-lg text-7xl text-white font-semibold">
                        <p>Sin registros de propiedades</p>
                    </div>
                </div>
            </div>
        </div>
    </Navbar>
</template>

<style scoped>

</style>
