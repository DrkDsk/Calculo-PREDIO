<script setup>

defineProps({
    title: String
})

</script>

<template>
    <button type="submit" class="inline-block w-full px-5 py-4 text-xl font-medium text-center text-white transition duration-200 bg-blue-600 rounded-lg hover:bg-blue-500 ease">{{title}}</button>
</template>

<style scoped>

</style>
