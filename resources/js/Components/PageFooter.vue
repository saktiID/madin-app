<script setup>
import { HeartIcon } from "@heroicons/vue/solid";
</script>

<template>
    <footer class="flex-shrink-0 px-6 py-4 mt-7">
        <p
            class="flex items-center justify-center gap-1 text-sm text-gray-600 dark:text-gray-400"
        >
            <span>Dibuat dengan</span>

            <span>
                <HeartIcon class="w-6 h-6 text-red-500" />
                <span className="sr-only">Love</span>
            </span>

            <span>oleh</span>

            <a href="#" class="text-blue-600 hover:underline"> Romosakti </a>
        </p>
    </footer>
</template>
