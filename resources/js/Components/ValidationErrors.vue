<script setup>
import { computed, onUpdated } from "vue";
import { usePage } from "@inertiajs/vue3";

const errors = computed(() => usePage().props.errors);
const hasErrors = computed(() => Object.keys(errors.value).length > 0);
onUpdated(() => {
    if (hasErrors) window.errorSFX.play();
});
</script>

<template>
    <div v-if="hasErrors">
        <div class="font-medium text-gray-100 text-center">
            Maaf! ada kesalahan.
        </div>

        <ul
            class="mt-3 list-disc list-inside text-sm text-white dark:text-gray-100"
        >
            <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
        </ul>
    </div>
</template>
