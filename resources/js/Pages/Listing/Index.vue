<template>
    <div v-for="listing in listings" :key="listing.id">
        <Link :href="`/listing/${listing.id}`">
            <ListingAdress :listing="listing" />
        </Link>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import ListingAdress from "@/Components/ListingAddress.vue";

const props = defineProps({
    listings: Array,
});
</script>
