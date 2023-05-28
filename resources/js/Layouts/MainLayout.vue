<template>
    <Link href="/listing">Listings</Link>
    &nbsp;
    <Link href="/listing/create">New Listing</Link>
    <div v-if="$page.props.flash" class="success">
        {{ $page.props.flash.success }}
    </div>
    <slot>Default</slot>
</template>
<script setup>
// Imports
// import { ref } from "vue";
import { computed } from "vue";
import { Link, usePage } from "@inertiajs/inertia-vue3";
// page.props.value.flash.success
const page = usePage();
// Refs
// Functions
</script>
<style scoped>
.success {
    color: green;
}
</style>
