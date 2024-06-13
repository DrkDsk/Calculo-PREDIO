<script setup>

import Navbar from "@/Layouts/Navbar.vue";
import Store from "@/Pages/Calculos/Store.vue";

const props = defineProps({
    ground: Object,
    balance: Object
})

</script>

<template>
    <Navbar>
        <div class="w-10/12 mx-auto mt-10">
            <Store :ground="ground" :balance="balance" route-name="balances.update" :id="props.balance.id" :update-view="true"></Store>
        </div>
    </Navbar>
</template>

<style scoped>
</style>
