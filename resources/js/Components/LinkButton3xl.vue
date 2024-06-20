<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    routeName : String,
    title: String
})
</script>

<template>
    <Link class="text-white px-8 py-1 md:px-5 md:py-2 bg-blue-500 rounded-md" :href="routeName">
        {{title}}
    </Link>
</template>

<style scoped>

</style>
