<script setup>

import Navbar from "@/Layouts/Navbar.vue";
import Pagination from "@/Layouts/Pagination.vue";
import LinkSuccess4xl from "@/Components/LinkButtonSuccess4xl.vue";
import LinkSuccess from "@/Components/LinkSuccess.vue";
import LinkButton3xl from "@/Components/LinkButton3xl.vue";
import ButtonDelete3xl from "@/Components/ButtonDelete3xl.vue";
import {deleteOwner} from "@/utils/handleDeleteService.js";
import SearchComponent from "@/Components/SearchComponent.vue";
import {ref} from "vue";
import {router} from "@inertiajs/vue3";

const props = defineProps({
    owners : Object,
    search : String
})

const owners = ref([]);
const links = props.owners.meta
const isSearching = ref(false)
isSearching.value = props.search.length
owners.value = props.owners.data.map((owner) => owner);

const handleDeleteOwner = (owner_id) => {
    deleteOwner(owner_id)
}

const handleSearchOwner = async (search) => {
    isSearching.value = search.length
    let  params = {}
    if (search.length > 0) {
        params.search = search
    }

    router.get(route('owners.index'), params, {
        preserveState : true,
        onSuccess : (response) => {
            const ownerProp = response.props.owners
            owners.value = ownerProp.data.map((owner) => owner);
        }
    })
}

</script>

<template>
    <Navbar>
        <div class="mt-3 w-full flex flex-col items-center">
            <SearchComponent :search-field="props.search" place-holder="Buscar propietario" @search="handleSearchOwner"/>
            <div class="w-11/12 flex flex-col">
                <div class="flex justify-end my-4">
                    <LinkSuccess4xl :route-name="route('owners.create')" title="Registrar Propietario"></LinkSuccess4xl>
                </div>
                <div v-if="owners.length" class="w-full flex flex-col items-end">
                    <table class="w-full text-sm table-auto font-bold bg-cyan-900 rounded-lg mb-3">
                        <thead class="text-left uppercase">
                        <tr class="text-white">
                            <th scope="col" class="text-center py-4">No.</th>
                            <th scope="col" class="text-center py-4">Nombre</th>
                            <th scope="col" class="text-center py-4">Apellidos</th>
                            <th scope="col" class="text-center py-4">Número telefónico</th>
                            <th scope="col" class="text-center py-4">RFC</th>
                            <th scope="col" class="text-center py-4">Propiedades</th>
                            <th scope="col" class="text-center py-4">Ajustes</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y-8 divide-gray-100 border-gray-100">
                        <tr v-for="owner in owners" class="bg-white" style="border-radius: 10px">
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
                                        {{ owner.telephone ?? "Sin número telefónico" }}
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
                                        <LinkSuccess class="text-green-500" :route-name="route('owners.grounds.index', owner.id)" title="Ver propiedades">
                                        </LinkSuccess>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="text-sm py-2 px-4 text-center">
                                    <div class="font-medium gap-3 flex flex-row justify-center">
                                        <LinkButton3xl :route-name="route('owners.edit', owner.id)" title="Editar">
                                        </LinkButton3xl>

                                        <ButtonDelete3xl @delete="handleDeleteOwner(owner.id)" title="Eliminar">
                                        </ButtonDelete3xl>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <pagination class="my-6" :links="links" v-if="!isSearching"/>
                </div>
                <div v-else class="h-screen flex items-center justify-center">
                    <div class="bg-cyan-800 p-6 rounded-lg text-7xl text-white font-semibold">
                        <p>Sin registros de propietarios</p>
                    </div>
                </div>
            </div>
        </div>
    </Navbar>

</template>
