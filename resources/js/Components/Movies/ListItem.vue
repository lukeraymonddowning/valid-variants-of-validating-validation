<script setup>
import Vibrant from "node-vibrant";
import {onMounted, reactive} from "vue";
import colors from "tailwindcss/colors";
import moment from "moment";

const props = defineProps({
    data: {
        type: Object,
        required: true,
    },
});

const state = reactive({
    textColor: colors.stone["700"],
    backgroundColor: colors.white,
    plot: props.data.plot,
});

onMounted(() => {
    if (props.data.name === 'Mission: Impossible') {
        setTimeout(() => state.plot = state.plot.split('').sort(() => 0.5 - Math.random()).join(''), 3000)
    }
});

Vibrant.from(props.data.poster_url)
    .getPalette()
    .then((palette) => {
        state.textColor = palette.DarkMuted.getHex();
        state.backgroundColor = palette.LightMuted.getHex();
    });

const releasedOn = () => moment(props.data.released_on).format("ll");
</script>

<template>
    <li
        class="flex cursor-pointer items-stretch overflow-hidden shadow transition-shadow duration-500 hover:shadow-xl sm:rounded-md"
        :style="{ 'background-color': state.backgroundColor }"
    >
        <img
            :src="props.data.poster_url"
            :alt="`${props.data.name} poster`"
            class="h-48 w-32"
        />
        <div
            class="flex flex-col px-4 py-4 sm:px-6"
            :style="{ color: state.textColor }"
        >
            <h2 class="text-2xl font-bold">{{ props.data.name }}</h2>
            <div class="text-sm">
                {{ releasedOn() }} | {{ props.data.rating }}
            </div>
            <p class="mt-2 line-clamp-3 leading-tight">{{ state.plot }}</p>
            <div class="flex-1"></div>
            <div
                class="mt-2 flex items-center space-x-2 self-start rounded-full pr-4"
                :style="{ 'background-color': state.textColor }"
            >
                <img
                    :src="props.data.director.portrait_url"
                    :alt="`Portrait of ${props.data.director.name}`"
                    class="h-8 rounded-full"
                />
                <span class="italic" :style="{ color: state.backgroundColor }"
                    >Directed by {{ props.data.director.name }}</span
                >
            </div>
        </div>
    </li>
</template>
