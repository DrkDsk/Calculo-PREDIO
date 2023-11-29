<script setup>

import Navbar from "@/Layouts/Navbar.vue";
import Store from "@/Pages/Calculos/Store.vue";

const props = defineProps({
    ground : Object
})

</script>

<template>
    <Navbar>
        <Store :ground="ground" route-name="terrenos.calculos.store" :id="ground.id" title-button="Guardar cálculo"></Store>
    </Navbar>
</template>

<style scoped>
</style>
