<script setup>

import Navbar from "@/Layouts/Navbar.vue";
import Store from "@/Pages/Calculos/Store.vue";
import ExcelView from "@/Components/ExcelView.vue";
import {ref} from "vue";
import {fetchExcel} from "@/utils/excel.js";

const props = defineProps({
    ground : Object,
    years : Object,
    excelUrl: String
})

const sheetVisibleIndex = ref(0)
const sheetData = ref([])

const handleFetchExcel = async (sheetIndex) => {
    sheetData.value = await fetchExcel(sheetIndex, props.excelUrl)
    sheetVisibleIndex.value = sheetIndex
}

</script>

<template>
    <Navbar>
        <div class="w-10/12 mx-auto mt-10">
            <div class="mt-4 space-x-2">
                <button v-if="sheetVisibleIndex !== 1" class="my-4 bg-green-400 px-3 py-1.5 rounded-md text-white" @click="handleFetchExcel(1)">Cargar hoja de INPC</button>
                <button v-if="sheetVisibleIndex !== 2" class="my-4 bg-yellow-400 px-3 py-1.5 rounded-md text-white" @click="handleFetchExcel(2)">Cargar hoja de recargos</button>
            </div>
            <Store :ground="ground" :years="years" route-name="grounds.balances.store" :id="ground.id" title-button="Guardar cálculo"></Store>
            <div class="my-4">
                <ExcelView v-if="sheetVisibleIndex === 1" :sheet-data="sheetData"/>
                <ExcelView v-if="sheetVisibleIndex === 2" :sheet-data="sheetData"/>
            </div>
        </div>
    </Navbar>
</template>

<style scoped>
</style>
