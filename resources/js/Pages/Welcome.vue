<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";

</script>

<template>
    <Head title="Valid Variants of Validating Validation" />

    <div
        class="items-top relative flex min-h-screen justify-center bg-teal-400 sm:items-center sm:pt-0"
    >
        <div class="group relative flex">
            <img src="/assets/angry-parrot.png" class="absolute w-full object-contain top-1 h-16 z-0 group-hover:-translate-y-16 transform duration-500">
            <Link :href="route('movies.index')" class="z-10 text-3xl uppercase bg-black text-white py-6 px-16 rounded hover:bg-gray-900">Let's Go</Link>
        </div>
    </div>
</template>
