<template>
    <header
        class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 w-full"
    >
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium">
                    <Link :href="route('realtor.listing.index')">Listings</Link>
                </div>
                <div
                    class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center"
                >
                    <Link :href="route('listing.index')"
                        >Laravel Inertia VueJs</Link
                    >
                </div>
                <div v-if="$page.props.user" class="flex items-center gap-4">
                    <Link
                        class="text-sm text-gray-500"
                        :href="route('realtor.listing.index')"
                        >{{ $page.props.user.name }}</Link
                    >

                    <Link
                        :href="route('realtor.listing.create')"
                        class="btn-primary"
                        >+ New Listing</Link
                    >
                    <div>
                        <Link
                            :href="route('logout')"
                            method="delete"
                            as="button"
                            >Logout</Link
                        >
                    </div>
                </div>
                <div v-else class="flex items-center gap-2">
                    <Link :href="route('user-account.create')">Register</Link>
                    <Link :href="route('login')">Sign-In</Link>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto p-4 w-full">
        <div
            v-if="$page.props.flash.success"
            class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2"
        >
            {{ $page.props.flash.success }}
        </div>
        <slot>Default</slot>
    </main>
</template>
<script setup>
// Imports
// import { ref } from "vue";
import { computed } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { usePage } from "@inertiajs/vue3";
// page.props.value.flash.success
// Refs
// Functions
</script>
<style scoped>
.success {
    color: green;
}
</style>
