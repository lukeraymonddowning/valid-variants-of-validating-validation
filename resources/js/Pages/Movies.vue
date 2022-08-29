<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';
import ListItem from "@/Components/Movies/ListItem.vue";

const props = defineProps({
    movies: {
        type: Array,
        required: true,
    }
});
</script>

<template>
    <Head title="Movies"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Movies
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <ul role="list" class="space-y-3">
                    <list-item v-for="movie in props.movies" :data="movie"></list-item>
                </ul>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
