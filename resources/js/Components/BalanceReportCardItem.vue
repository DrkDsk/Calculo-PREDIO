<script setup>

defineProps({
    label: String,
    value: String
})

</script>

<template>
    <div class="max-w-sm mx-auto">
        <div class="bg-white shadow-lg rounded-lg p-6 space-y-4 h-40">
            <div class="flex items-center">
                <div class="space-y-4">
                    <div class="text-gray-600 text-xl">{{label}}</div>
                    <div class="text-gray-900 text-2xl font-semibold">
                        ${{value}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
