<template>
    <div
        v-if="mensaje"
        class="px-4 py-3 rounded-lg text-sm border"
        :class="esError
            ? 'bg-red-50 text-red-600 border-red-200'
            : 'bg-green-50 text-green-700 border-green-200'"
    >
        {{ mensaje }}
    </div>
</template>

<script setup>
defineProps({
    mensaje: String,
    esError: {
        type: Boolean,
        default: true,
    },
})
</script>