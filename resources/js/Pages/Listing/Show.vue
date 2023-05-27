<template>
    <div>
        <ListingAdress :listing="listing" />
    </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import ListingAdress from "@/Components/ListingAddress.vue";
const props = defineProps({
    listing: Object,
});
</script>
