<script setup>
import { reactive, ref, watch } from "vue";
import { useDragAndDrop } from "@/src/drag-and-drop";

const props = defineProps({
    id: {
        type: String,
        required: true,
    },
});

const state = reactive({
    preview: null,
});

const emit = defineEmits(["update:modelValue"]);

const dropArea = ref(null);
const { file, isBeingDraggedOver } = useDragAndDrop(dropArea);

watch(file, (value) => {
    state.preview = URL.createObjectURL(value);
    emit("update:modelValue", value);
});

const handleFileInputChange = (event) => (file.value = event.target.files[0]);
</script>

<template>
    <div
        ref="dropArea"
        class="flex max-w-lg justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6"
        :class="{ 'border-indigo-600': isBeingDraggedOver }"
    >
        <div
            class="space-y-1 text-center"
            :class="{ 'pointer-events-none': isBeingDraggedOver }"
        >
            <img
                v-if="state.preview"
                :src="state.preview"
                alt="Image preview"
                class="mx-auto mb-2 h-32"
            />
            <svg
                v-else
                class="mx-auto h-12 w-12 text-gray-400"
                stroke="currentColor"
                fill="none"
                viewBox="0 0 48 48"
                aria-hidden="true"
            >
                <path
                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
            <div class="flex text-sm text-gray-600">
                <label
                    :for="props.id"
                    class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500"
                >
                    <span>Upload a file</span>
                    <input
                        @change="handleFileInputChange"
                        :id="props.id"
                        type="file"
                        class="sr-only"
                    />
                </label>
                <p class="pl-1">or drag and drop</p>
            </div>
            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
        </div>
    </div>
</template>
