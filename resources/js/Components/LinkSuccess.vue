<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    routeName : String,
    title: String
})
</script>

<template>
    <Link class="text-white bg-green-500 rounded-md px-8 py-1 md:px-2 md:py-2" :href="routeName">
        {{title}}
    </Link>
</template>

<style scoped>

</style>
