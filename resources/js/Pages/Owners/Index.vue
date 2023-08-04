<script setup>

import { Link } from '@inertiajs/vue3';

const props = defineProps({
    owners : Object
})
</script>

<template>
    <div class="w-full flex flex-row justify-center m-5">
        <table class="w-10/12 text-sm table-auto font-bold bg-blue-500">
            <thead class="text-left uppercase">
            <tr class="text-white">
                <th scope="col" class="text-center py-4">Nombre</th>
                <th scope="col" class="text-center py-4">Apellidos</th>
                <th scope="col" class="text-center py-4">Número telefónico</th>
                <th scope="col" class="text-center py-4">RFC</th>
                <th scope="col" class="text-center py-4">Ajustes</th>
            </tr>
            </thead>
            <tbody class="divide-y-8 divide-gray-100 border-gray-100">
            <tr v-for="owner in owners" class="bg-white" style="border-radius: 10px">
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
                        <div class="font-medium text-blue-500">
                            <Link :href="route('propietarios.terrenos.create', owner.id)">
                                Asignar Terreno
                            </Link>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

</template>
