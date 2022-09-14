<script setup>
import {
    Dialog,
    DialogTitle,
    DialogPanel,
    TransitionRoot,
    TransitionChild,
} from "@headlessui/vue";
import {nextTick, reactive, ref, watch} from "vue";

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    description: {
        type: String,
        required: false,
    },
    active: {
        type: Boolean,
        required: true,
    },
});

const emit = defineEmits(["close"]);

const renderParrot = ref(false);
const showParrot = ref(false);

watch(props, async (props) => {
    if (!props.active) {
        return;
    }

    setTimeout(() => showParrot.value = true, 500);
}, {deep: true});
</script>

<template>
    <TransitionRoot as="template" :show="props.active">
        <Dialog as="div" class="relative z-10" @close="$emit('close')">
            <TransitionChild
                as="template"
                enter="ease-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in duration-200"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div
                    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div
                    class="flex relative min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
                >
                    <div v-show="renderParrot"
                         class="absolute w-32 top-16 left-28 -rotate-90 duration-1000"
                         :class="{ '-translate-x-24': showParrot }"
                    >
                        <img src="/assets/angry-parrot.png" alt="" class=""/>
                    </div>
                    <TransitionChild
                        as="template"
                        enter="ease-out duration-300"
                        enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        enter-to="opacity-100 translate-y-0 sm:scale-100"
                        leave="ease-in duration-200"
                        leave-from="opacity-100 translate-y-0 sm:scale-100"
                        leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        @after-enter="renderParrot = true"
                        @beforeLeave="showParrot = false"
                    >
                        <DialogPanel
                            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-5xl"
                        >
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="">
                                    <div
                                        class="mt-3 text-center sm:mt-0 sm:text-left"
                                    >
                                        <DialogTitle
                                            as="h3"
                                            class="text-lg font-medium leading-6 text-gray-900"
                                        >{{ props.title }}
                                        </DialogTitle
                                        >
                                        <div
                                            v-if="props.description"
                                            class="my-2"
                                        >
                                            <p class="text-sm text-gray-500">
                                                {{ props.description }}
                                            </p>
                                        </div>
                                        <slot name="form"/>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6"
                            >
                                <slot name="actions"/>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
