<script setup>
import {Link} from '@inertiajs/vue3';

const props = defineProps({
    links: Object
})

const metaLinks = props.links

</script>

<template>
    <div v-if="metaLinks.total > metaLinks.per_page">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, p) in metaLinks.links" :key="p">
                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-white border rounded" v-html="link.label" />
                <Link v-else class="text-white mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white hover:text-blue-700 focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-blue-700 text-white': link.active }" :href="link.url" v-html="link.label"></Link>
            </template>
        </div>
    </div>
</template>

<style scoped>

</style>
