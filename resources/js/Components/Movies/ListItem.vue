<script setup>
import Vibrant from 'node-vibrant';
import {reactive} from "vue";
import colors from 'tailwindcss/colors';
import moment from "moment";

const props = defineProps({
    data: {
        type: Object,
        required: true,
    }
});

const state = reactive({
    textColor: colors.stone["700"],
    backgroundColor: colors.white,
});

Vibrant.from(props.data.poster_url)
    .getPalette()
    .then(palette => {
        state.textColor = palette.DarkMuted.getHex();
        state.backgroundColor = palette.LightMuted.getHex();
    });

const releasedOn = () => moment(props.data.released_on).format('ll');

</script>

<template>
    <li class="shadow overflow-hidden sm:rounded-md flex items-stretch" :style="{'background-color': state.backgroundColor}">
        <img :src="data.poster_url" :alt="`${data.name} poster`" class="h-48 w-32">
        <div class="flex flex-col px-4 py-4 sm:px-6" :style="{'color': state.textColor}">
            <h2 class="text-2xl font-bold">{{ data.name }}</h2>
            <div class="text-sm">{{ releasedOn() }} | {{ data.rating }}</div>
            <p class="mt-2 flex-1">{{ data.plot }}</p>
            <span class="italic">Directed by {{ data.director }}</span>
        </div>
    </li>
</template>
