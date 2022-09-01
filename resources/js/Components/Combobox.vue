<script setup>
import { computed, reactive, ref } from "vue";
import { CheckIcon, ChevronUpDownIcon } from "@heroicons/vue/20/solid";
import {
    Combobox,
    ComboboxButton,
    ComboboxInput,
    ComboboxOption,
    ComboboxOptions,
} from "@headlessui/vue";

const props = defineProps({
    modelValue: {
        required: true,
    },
    options: {
        type: Array,
        required: true,
    },
});

const state = reactive({
    query: "",
});

const emit = defineEmits(["update:modelValue"]);

const filteredOptions = computed(() => {
    const options =
        state.query.value === ""
            ? props.options
            : props.options.filter((value) => {
                  return value.name
                      .toLowerCase()
                      .includes(state.query.toLowerCase());
              });

    return options.length > 0 ? options : [{ id: null, name: state.query }];
});

const handleInput = (selectedOption) => {
    emit("update:modelValue", selectedOption);
};
</script>

<template>
    <Combobox
        as="div"
        :model-value="props.modelValue"
        @update:modelValue="handleInput($event)"
        nullable
    >
        <div class="relative">
            <ComboboxInput
                class="w-full rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
                @change="state.query = $event.target.value"
                :display-value="(option) => option?.name"
            />
            <ComboboxButton
                class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none"
            >
                <ChevronUpDownIcon
                    class="h-5 w-5 text-gray-400"
                    aria-hidden="true"
                />
            </ComboboxButton>

            <ComboboxOptions
                v-if="filteredOptions.length > 0"
                class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
            >
                <ComboboxOption
                    v-for="option in filteredOptions"
                    :key="option.id"
                    :value="option"
                    as="template"
                    v-slot="{ active, selected }"
                >
                    <li
                        :class="[
                            'relative cursor-default select-none py-2 pl-3 pr-9',
                            active
                                ? 'bg-indigo-600 text-white'
                                : 'text-gray-900',
                        ]"
                    >
                        <span
                            :class="[
                                'block truncate',
                                selected && 'font-semibold',
                            ]"
                        >
                            {{ option.name }}
                        </span>

                        <span
                            v-if="selected"
                            :class="[
                                'absolute inset-y-0 right-0 flex items-center pr-4',
                                active ? 'text-white' : 'text-indigo-600',
                            ]"
                        >
                            <CheckIcon class="h-5 w-5" aria-hidden="true" />
                        </span>
                    </li>
                </ComboboxOption>
            </ComboboxOptions>
        </div>
    </Combobox>
</template>
