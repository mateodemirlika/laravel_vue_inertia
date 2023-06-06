<template>
    <Box>
        <div>
            <Link :href="route('listing.show', { listing: listing.id })">
                <div>
                    <Price :price="listing.price" class="text-2xl font-bold" />
                    <div class="text-xs text-gray-500">
                        <Price
                            :price="monthlyPayment"
                            class="text-2xl font-bold"
                        />pm
                    </div>
                </div>
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-gray-500" />
            </Link>
        </div>
    </Box>
</template>
<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import ListingAddress from "@/Components/ListingAddress.vue";
import ListingSpace from "@/Components/ListingSpace.vue";
import Price from "@/Components/Price.vue";
import Box from "@/Components/UI/Box.vue";
import { useMonthlyPayment } from "@/Composables/useMonthlyPayment";
import { ref } from "vue";

const props = defineProps({
    listing: Object,
});
const interestRate = ref(2.5);
const duration = ref(25);
const { monthlyPayment } = useMonthlyPayment(
    props.listing.price,
    interestRate,
    duration
);
</script>
