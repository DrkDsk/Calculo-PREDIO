<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    routeName : String,
    title: String
})
</script>

<template>
    <Link class="text-white bg-blue-500 rounded-2xl p-0.5" :href="routeName">
        {{title}}
    </Link>
</template>

<style scoped>

</style>
