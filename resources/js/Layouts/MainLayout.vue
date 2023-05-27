<template>
    <Link href="/">Main Page</Link>
    &nbsp;
    <Link href="/show">Show Page</Link>
    <div>The page with timer {{ timer }}</div>
    <slot>Default</slot>
</template>
<script setup>
// Imports
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
// Refs
const timer = ref(0);
// Functions
setInterval(() => timer.value++, 1000);
</script>
 