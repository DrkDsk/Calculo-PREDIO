<script setup>

import Navbar from "@/Layouts/Navbar.vue";
import LinkSuccess4xl from "@/Components/LinkButtonSuccess4xl.vue";

const props = defineProps({
    federalSurcharges: Object
})

</script>

<template>
    <Navbar>
        <div class="mt-3 w-full flex flex-col items-center">
            <div class="w-11/12 flex flex-col">
                <div class="my-4 flex flex-row md:justify-end w-full mr-8">
                    <LinkSuccess4xl :route-name="route('surcharge.create')" title="Registrar Tasa de Recargo"></LinkSuccess4xl>
                </div>
                <table v-if="federalSurcharges.length" class="w-full text-sm table-auto font-bold bg-cyan-900 rounded-lg">
                    <thead class="text-left uppercase">
                    <tr class="text-white">
                        <th scope="col" class="text-center py-4 pl-3">Año</th>
                        <th scope="col" class="text-center py-4">Valor</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y-8 divide-gray-100 border-gray-100">
                    <tr v-for="surcharge in federalSurcharges" class="bg-white" style="border-radius: 10px">
                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium text-gray-700">
                                    {{ surcharge.year }}
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="text-sm py-2 px-4 text-center">
                                <div class="font-medium text-gray-700">
                                    {{ surcharge.value }}
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div v-else class="bg-cyan-800 p-6 rounded-3xl text-white">
                    <p>Sin registros de tasa de recargos</p>
                </div>
            </div>

        </div>
    </Navbar>
</template>

<style scoped>

</style>
