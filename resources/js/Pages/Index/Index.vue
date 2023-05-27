<template>
    <div>Index</div>
    <Link href="/show">Show</Link>
    <div>{{ props.message }}</div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    message: String,
});
</script>
