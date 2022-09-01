<script setup>
const props = defineProps({
    modelValue: {
        required: true,
    },
    rows: {
        type: Number,
        default: 4,
    },
});

const emit = defineEmits(["update:modelValue"]);
</script>

<template>
    <textarea
        :value="props.modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :rows="props.rows"
        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
    />
</template>
