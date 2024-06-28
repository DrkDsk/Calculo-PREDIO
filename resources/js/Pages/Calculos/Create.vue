<script setup>

import Navbar from "@/Layouts/Navbar.vue";
import Store from "@/Pages/Calculos/Store.vue";
import ExcelView from "@/Components/ExcelView.vue";
import {ref} from "vue";
import {fetchExcel} from "@/utils/excel.js";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    ground : Object,
    years : Object,
    excelUrl: String
})

const sheetVisibleIndex = ref(0)
const sheetData = ref([])
const balancesNotExists = ref(false)

const handleFetchExcel = async (sheetIndex) => {
    if (props.excelUrl) {
        sheetData.value = await fetchExcel(sheetIndex, props.excelUrl)
        sheetVisibleIndex.value = sheetIndex
        return ;
    }

    return balancesNotExists.value = true
}

</script>

<template>
    <Navbar>
        <div class="w-10/12 mx-auto mt-10">
            <Store :ground="ground" :years="years" route-name="grounds.balances.store" :id="ground.id" title-button="Guardar cálculo"></Store>
            <div class="my-4">
                <div v-if="balancesNotExists" class="w-1/2">
                    <p class="bottom-3 right-3 bg-red-600 px-5 py-1 font-semibold text-white rounded-xl">
                        Archivo no importado: <Link class="text-white underline" :href="route('files.create')">Cargar archivo</Link>
                    </p>
                </div>
                <div class="mt-4 space-x-2">
                    <button v-if="sheetVisibleIndex !== 1" class="my-4 bg-green-400 px-3 py-1.5 rounded-md text-white" @click="handleFetchExcel(1)">Cargar hoja de INPC</button>
                    <button v-if="sheetVisibleIndex !== 2" class="my-4 bg-yellow-400 px-3 py-1.5 rounded-md text-white" @click="handleFetchExcel(2)">Cargar hoja de recargos</button>
                </div>
                <ExcelView v-if="sheetVisibleIndex === 1" :sheet-data="sheetData"/>
                <ExcelView v-if="sheetVisibleIndex === 2" :sheet-data="sheetData"/>
            </div>
        </div>
    </Navbar>
</template>

<style scoped>
</style>
