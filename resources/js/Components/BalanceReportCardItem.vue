<script setup>

defineProps({
    label: String,
    value: Number
})

</script>

<template>
    <div class="mx-auto">
        <div class="bg-white shadow-lg rounded-lg p-6 space-y-4 h-48">
            <div class="flex items-center">
                <div class="space-y-4">
                    <div class="text-gray-600 text-3xl font-black">{{label}}</div>
                    <div class="text-2xl font-semibold text-green-600">
                        ${{value}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
