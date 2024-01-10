<script setup>

import Navbar from "@/Layouts/Navbar.vue";
import TasaRecargoIndexComponent from "@/Pages/TasaRecargos/TasaRecargoIndexComponent.vue";
import LinkSuccess4xl from "@/Components/LinkButtonSuccess4xl.vue";

const props = defineProps({
    federalSurcharges: Object
})

</script>

<template>
    <Navbar>
        <div class="flex flex-col">
            <div class="w-full flex flex-row justify-end mt-2 px-14">
                <LinkSuccess4xl :route-name="route('surcharge.create')" title="Registrar Tasa de Recargo"></LinkSuccess4xl>
            </div>
            <TasaRecargoIndexComponent :federal-surcharges="federalSurcharges"></TasaRecargoIndexComponent>
        </div>
    </Navbar>
</template>

<style scoped>

</style>
