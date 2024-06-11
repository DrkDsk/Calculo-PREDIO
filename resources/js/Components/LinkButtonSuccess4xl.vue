<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    routeName : String,
    title: String
})
</script>

<template>
    <Link class="text-white rounded-md p-3 bg-emerald-600 hover:scale-110 hover:duration-150" :href="routeName">
        {{title}}
    </Link>
</template>

<style scoped>

</style>
