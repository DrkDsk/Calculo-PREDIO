<script setup>


defineProps({
    placeHolder: String,
    searchField : String
})

const emit = defineEmits(['search']);

const handleInput = (event) => {
    emit('search', event.target.value);
};

</script>

<template>
    <div class="bg-white rounded-md px-4 py-2 w-11/12 flex flex-row justify-end">
        <input :value="searchField" @input="handleInput" :placeholder="placeHolder" class="block w-full px-4 py-4 mt-2 text-base placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:border-black">
    </div>
</template>

<style scoped>

</style>
