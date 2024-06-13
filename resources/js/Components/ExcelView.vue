<script setup>

const props = defineProps({
    sheetData : Array
})

</script>

<template>
    <div v-if="sheetData.length" class=" rounded-lg mx-auto font-medium">
        <table class="divide-y divide-gray-200 min-w-full">
            <thead class="bg-gray-50">
            <tr>
                <th v-for="(header, index) in sheetData[0]" :key="index" class="p-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{header}}
                </th>
            </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="(row, rowIndex) in sheetData.slice(1)" :key="rowIndex">
                <td class="p-2 whitespace-nowrap" v-for="(cell, cellIndex) in row" :key="cellIndex">{{cell}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>

</style>
