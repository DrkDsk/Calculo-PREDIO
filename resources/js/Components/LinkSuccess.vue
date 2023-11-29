<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    routeName : String,
    title: String
})
</script>

<template>
    <Link class="text-blue-600" :href="routeName">
        {{title}}
    </Link>
</template>

<style scoped>

</style>
