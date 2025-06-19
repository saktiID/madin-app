<script setup>
import { ref, computed } from "vue";
import {
    DownloadIcon,
    UploadIcon,
    PlusCircleIcon,
    TableIcon,
} from "@heroicons/vue/solid";

const props = defineProps({
    name: String,
    icon: {
        type: String,
        default: "plus",
        validator(value) {
            return ["download", "upload", "plus", "excel"].includes(value);
        },
    },
});
const tooltipVisible = ref(null);
const showTooltip = (tooltipId) => {
    tooltipVisible.value = tooltipId;
};
const hideTooltip = () => {
    tooltipVisible.value = null;
};
const emit = defineEmits(["click"]);
const click = () => emit("click");

const Tag = computed(() => {
    switch (props.icon) {
        case "download":
            return DownloadIcon;
        case "upload":
            return UploadIcon;
        case "plus":
            return PlusCircleIcon;
        case "excel":
            return TableIcon;
        default:
            return PlusCircleIcon;
    }
});

// const Tag = DownloadIcon;
</script>

<template>
    <div class="relative">
        <button
            @mouseover="showTooltip(props.name)"
            @mouseleave="hideTooltip()"
            @click="click"
            type="button"
            class="flex justify-center items-center w-[46px] h-[46px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-lg dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400"
        >
            <slot name="icon"></slot>
            <component :is="Tag" class="w-6 h-6"></component>
            <span class="sr-only">{{ props.name }}</span>
        </button>
        <div
            v-show="tooltipVisible === props.name"
            class="absolute z-10 inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-lg tooltip dark:bg-gray-700 right-16 top-1.5"
        >
            {{ props.name }}
            <div
                class="absolute right-[-16px] top-1/2 -translate-y-1/2 w-0 h-0 border-[8px] border-transparent border-l-gray-900 dark:border-l-gray-700"
            ></div>
        </div>
    </div>
</template>
