<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
defineProps({
    title: String,
});

</script>

<template>
    <div>
        <Head :title=" title " />

        <Banner />


        <!-- Page Heading -->
        <main class="flex h-full h-screen">
            <header v-if=" $slots.header " class="bg-gray-800 shadow bg-gray-200 w-80">

                <slot name="header" />
            </header>
            <div v-if=" $slots.content " class="bg-white shadow w-full">
                <slot name="content" />
            </div>
        </main>
    </div>
</template>
