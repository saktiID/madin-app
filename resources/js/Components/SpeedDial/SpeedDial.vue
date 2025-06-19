<script setup>
import { PlusIcon } from "@heroicons/vue/solid";
import { ref, onMounted, onUnmounted } from "vue";

const showDial = ref(false);

const handleClickOutside = (event) => {
    if (!event.target.closest("#dial-button") && showDial.value) {
        showDial.value = false;
    }
};

const toggleDial = () => {
    showDial.value = !showDial.value;
};

onMounted(() => {
    document.addEventListener("click", handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener("click", handleClickOutside);
});
</script>

<template>
    <div data-dial-init class="fixed end-6 bottom-6 group">
        <div
            v-show="showDial"
            id="speed-dial-menu-default"
            class="flex flex-col items-center mb-4 space-y-2"
        >
            <slot></slot>
        </div>

        <button
            type="button"
            class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800"
            @click="toggleDial"
            id="dial-button"
        >
            <PlusIcon
                class="w-7 h-7 transition-transform group-hover:rotate-45"
            />

            <span class="sr-only">Open actions menu</span>
        </button>
    </div>
</template>
