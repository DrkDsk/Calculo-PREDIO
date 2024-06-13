<script setup>

import Navbar from "@/Layouts/Navbar.vue";
import Pagination from "@/Layouts/Pagination.vue";
import LinkSuccess4xl from "@/Components/LinkButtonSuccess4xl.vue";
import LinkSuccess from "@/Components/LinkSuccess.vue";
import LinkButtonInfo3xl from "@/Components/LinkButtonInfo3xl.vue";
import ButtonDelete3xl from "@/Components/ButtonDelete3xl.vue";
import {deleteOwner} from "@/utils/handleDeleteService.js";

const props = defineProps({
    owners : Object
})

const handleDeleteOwner = (owner_id) => {
    deleteOwner(owner_id)
}

</script>

<template>
    <Navbar>
        <div class="mt-3 w-full flex flex-col items-center">
            <div class="my-4 flex flex-row md:justify-end w-full mr-8">
                <LinkSuccess4xl :route-name="route('owners.create')" title="Registrar Propietario"></LinkSuccess4xl>
            </div>
            <div v-if="owners.data.length" class="w-11/12 flex flex-col">
                <table class="w-full text-sm table-auto font-bold bg-cyan-900 rounded-lg">
                    <thead class="text-left uppercase">
                    <tr class="text-white">
                        <th scope="col" class="text-center py-4">No.</th>
                        <th scope="col" class="text-center py-4">Nombre</th>
                        <th scope="col" class="text-center py-4">Apellidos</th>
                        <th scope="col" class="text-center py-4">Número telefónico</th>
                        <th scope="col" class="text-center py-4">RFC</th>
                        <th scope="col" class="text-center py-4">Terrenos</th>
                        <th scope="col" class="text-center py-4">Ajustes</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y-8 divide-gray-100 border-gray-100">
                    <tr v-for="owner in owners.data" class="bg-white" style="border-radius: 10px">
                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium text-gray-700">
                                    {{ owner.id }}
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium text-gray-700">
                                    {{ owner.name }}
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium text-gray-700">
                                    {{ owner.last_name }}
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium text-gray-700">
                                    {{ owner.telephone }}
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium text-gray-700" v-if="owner.RFC">
                                    {{ owner.RFC }}
                                </div>
                                <div class="font-medium text-red-400" v-else>
                                    SIN RFC
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium flex flex-col gap-3">
                                    <LinkSuccess class="text-green-500" :route-name="route('owners.grounds.index', owner.id)" title="Ver terrenos">
                                    </LinkSuccess>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium gap-3 flex flex-row justify-center">
                                    <LinkButtonInfo3xl :route-name="route('owners.edit', owner.id)" title="Editar">
                                    </LinkButtonInfo3xl>

                                    <ButtonDelete3xl @delete="handleDeleteOwner(owner.id)" title="Eliminar">
                                    </ButtonDelete3xl>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <pagination class="my-6 mx-auto" :links="owners.links"></pagination>
            </div>
            <div v-else class="h-screen flex items-center justify-center">
                <div class="bg-cyan-800 p-6 rounded-lg text-7xl text-white font-semibold">
                    <p>Sin registros de propietarios</p>
                </div>
            </div>
        </div>
    </Navbar>

</template>
