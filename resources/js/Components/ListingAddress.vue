<template>
    <span>
        {{ listing.street_nr }}, {{ listing.city }} for {{ listing.price }}$
    </span>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    listing: Object,
});
</script>
