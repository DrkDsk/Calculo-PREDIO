<script setup>

import { Link } from '@inertiajs/vue3';
import Navbar from "@/Layouts/Navbar.vue";
import Pagination from "@/Layouts/Pagination.vue";

const props = defineProps({
    owners : Object
})

</script>

<template>
    <Navbar>
        <div class="mt-3 w-full flex flex-col items-center">
            <div class="flex flex-row justify-end my-4 w-full mr-8">
                <Link :href="route('propietarios.create')" class="text-white rounded-full p-3 bg-emerald-600 hover:scale-110 hover:duration-150">
                    Registrar Propietario
                </Link>
            </div>
            <table v-if="owners.data.length" class="w-10/12 text-sm table-auto font-bold bg-cyan-900 rounded-lg">
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
                            <div class="font-medium flex flex-col">
                                <Link class="text-blue-500" :href="route('propietarios.terrenos.create', owner.id)">
                                    Asignar Terreno
                                </Link>
                                <Link class="text-green-600" :href="route('propietarios.terrenos.index', owner.id)">
                                    Ver terrenos
                                </Link>
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="text-sm py-2 px-4 text-center">
                            <div class="font-medium gap-3 flex flex-row">
                                <Link class="text-green-500" :href="route('propietarios.edit', owner.id)">
                                    Editar
                                </Link>
                                <Link class="text-red-600" :href="route('propietarios.terrenos.index', owner.id)">
                                    Eliminar
                                </Link>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <div v-else class="bg-cyan-800 p-6 rounded-3xl">
                <p>Sin registros de propietarios</p>
            </div>
            <pagination class="mt-6" :links="owners.links"></pagination>
        </div>
    </Navbar>

</template>
