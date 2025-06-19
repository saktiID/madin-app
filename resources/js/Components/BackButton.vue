<script setup>
import Button from "./Button.vue";
import { ChevronLeftIcon } from "@heroicons/vue/solid";

defineProps({
    href: String,
    headerTeks: String,
});
</script>

<template>
    <div class="flex flex-row gap-4 items-center">
        <Button
            variant="secondary"
            :href="route(href)"
            iconOnly
            title="Kembali"
        >
            <ChevronLeftIcon class="w-7 h-7" />
        </Button>
        <h2 class="text-xl font-semibold leading-tight">{{ headerTeks }}</h2>
    </div>
</template>
