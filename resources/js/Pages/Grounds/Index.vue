<script setup>
import Navbar from "@/Layouts/Navbar.vue";
import Pagination from "@/Layouts/Pagination.vue";
import LinkButton3xl from "@/Components/LinkButton3xl.vue";
import SearchComponent from "@/Components/SearchComponent.vue";
import {router} from "@inertiajs/vue3";
import {ref} from "vue";

const props = defineProps({
    grounds : Object,
    search : String
})

const grounds = ref([]);
const links = props.grounds.meta
const isSearching = ref(false)
isSearching.value = props.search.length
grounds.value = props.grounds.data.map((ground) => ground);

const handleSearchGround = async (search) => {
    isSearching.value = search.length
    let params = {}
    if (search.length > 0) {
        params.search = search
    }

    router.get(route('grounds.index'), params, {
        preserveState : true,
        onSuccess : (response) => {
            const groundProp = response.props.grounds
            grounds.value = groundProp.data.map((ground) => ground);
        }
    })
}

</script>

<template>
    <Navbar>
        <div class="mt-3 w-full flex flex-col items-center">
            <SearchComponent :search-field="props.search" place-holder="Buscar propiedad" @search="handleSearchGround"/>
            <div class="w-11/12 flex flex-col mt-4">
                <div v-if="grounds.length" class="w-full flex flex-col items-end">
                    <table class="w-full text-sm table-auto font-bold bg-cyan-900 rounded-lg mb-3">
                        <thead class="text-left uppercase">
                        <tr class="text-white">
                            <th scope="col" class="text-center py-4">No.</th>
                            <th scope="col" class="text-center py-4">Dirección</th>
                            <th scope="col" class="text-center py-4">Número de Concesión</th>
                            <th scope="col" class="text-center py-4">Metros cuadrados</th>
                            <th scope="col" class="text-center py-4">Tipo</th>
                            <th scope="col" class="text-center py-4">Propietario</th>
                            <th scope="col" class="text-center py-4">Cálculo INCP</th>
                            <th scope="col" class="text-center py-4">Opciones</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y-8 divide-gray-100 border-gray-100">
                        <tr v-for="ground in grounds" class="bg-white" style="border-radius: 10px">
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
                                    <div class="font-medium flex flex-row justify-center gap-3">
                                        <LinkButton3xl :route-name="route('grounds.balances.create', ground.id)" title="Realizar cálculo">
                                        </LinkButton3xl>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="text-sm py-2 px-4 text-center">
                                    <div class="font-medium flex flex-row justify-center">
                                        <LinkButton3xl :route-name="route('grounds.edit', ground.id)" title="Editar">
                                        </LinkButton3xl>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <pagination class="my-6 mx-auto" :links="links" v-if="!isSearching"></pagination>
                </div>
                <div v-else class="h-screen flex items-center justify-center">
                    <div class="bg-cyan-800 p-6 rounded-lg text-7xl text-white font-semibold">
                        <p>Sin registros de terrenos</p>
                    </div>
                </div>
            </div>
        </div>
    </Navbar>
</template>

<style scoped>

</style>
