<script setup>

import Navbar from "@/Layouts/Navbar.vue";
import Store from "@/Pages/Calculos/Store.vue";
import ExcelView from "@/Components/ExcelView.vue";
import {ref} from "vue";
import axios from "axios";
import * as XLSX from "xlsx";

const props = defineProps({
    ground : Object,
    years : Object,
    excelUrl: String
})

const sheetVisibleIndex = ref(0)

const fetchExcel = async (sheetIndex) => {

    try {
        const response = await axios.get(props.excelUrl, {
            responseType: 'arraybuffer'
        })

        const data = new Uint8Array(response.data);
        const workbook = XLSX.read(data, {type: 'array'})
        const sheetName = workbook.SheetNames[sheetIndex]
        const workSheet = workbook.Sheets[sheetName]
        sheetDataForINPC.value = XLSX.utils.sheet_to_json(workSheet, {header: 1});

        sheetVisibleIndex.value = sheetIndex
    } catch (error) {
        console.error("Error al cargar archivo")
    }
}

const sheetDataForINPC = ref([])

</script>

<template>
    <Navbar>
        <div class="mt-14 w-10/12 mx-auto">
            <div class="mx-10 space-x-2">
                <button class="my-4 bg-green-400 px-3 py-1.5 rounded-md text-white" @click="fetchExcel(1)">Cargar hoja de INPC</button>
                <button class="my-4 bg-yellow-400 px-3 py-1.5 rounded-md text-white" @click="fetchExcel(2)">Cargar hoja de recargos</button>
            </div>
        </div>
        <div class="mx-10">
            <Store :ground="ground" :years="years" route-name="terrenos.calculos.store" :id="ground.id" title-button="Guardar cálculo"></Store>
        </div>
        <ExcelView v-if="sheetVisibleIndex === 1" :sheet-data="sheetDataForINPC"/>
        <ExcelView v-if="sheetVisibleIndex === 2" :sheet-data="sheetDataForINPC"/>
    </Navbar>
</template>

<style scoped>
</style>
