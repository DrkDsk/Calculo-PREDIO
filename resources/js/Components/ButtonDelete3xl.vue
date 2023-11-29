<script setup>

const props = defineProps({
    title: String,
    method: {
        type: Function,
    }
})

const emit = defineEmits(['delete']);

const emitFunction = () => {
    emit('delete');
}

</script>

<template>
    <button v-on:click="emitFunction" class="text-white px-8 py-1 md:px-5 md:py-2 bg-red-500 rounded-3xl">
        {{title}}
    </button>
</template>

<style scoped>

</style>
