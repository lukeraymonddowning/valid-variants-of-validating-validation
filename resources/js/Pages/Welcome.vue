<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";

</script>

<template>
    <Head title="Valid Variants of Validating Validation" />

    <div
        class="items-top relative flex min-h-screen justify-center bg-teal-400 dark:bg-gray-900 sm:items-center sm:pt-0"
    >
        <Link :href="route('movies.index')" class="text-3xl uppercase bg-black text-white py-6 px-16 rounded hover:bg-gray-900">Let's Go</Link>
    </div>
</template>
