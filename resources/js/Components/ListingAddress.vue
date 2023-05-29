<template>
    <span>
        {{ listing.street }} {{ listing.street_nr }}, {{ listing.city }}
    </span>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    listing: Object,
});
</script>
