<script setup>
import { PreviousIcon, NextIcon } from "@/Components/Icons/solid";

defineProps({
    data: Object,
    only: Array,
});

const makeLabel = (label) => {
    if (label.includes("Sebelumnya")) {
        return PreviousIcon;
    } else if (label.includes("Berikutnya")) {
        return NextIcon;
    } else {
        return label;
    }
};
</script>

<template>
    <component
        v-for="(link, index) in data.links"
        :key="index"
        :is="link.url ? 'Link' : 'li'"
        :href="link.url"
        :only="only"
        preserve-state
        preserve-scroll
        :class="[
            'flex items-center justify-center px-4 h-10 leading-tight bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',
            {
                'z-10 border border-blue-400 bg-blue-100 text-blue-600 dark:border-gray-400 dark:bg-gray-400 dark:text-white':
                    link.active,
                'text-gray-500': !link.active,
                'rounded-s-lg': index === 0,
                'rounded-e-lg': index === data.links.length - 1,
                'text-slate-300 dark:text-slate-700': !link.url,
            },
        ]"
    >
        <component
            :is="makeLabel(link.label)"
            v-if="typeof makeLabel(link.label) === 'object'"
        />
        <span v-else>{{ makeLabel(link.label) }}</span>
    </component>
</template>
