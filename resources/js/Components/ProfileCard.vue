<script setup>
import { useUserStore } from "@/Stores/useUserStore";
import { ref, computed } from "vue";
import { sidebarState } from "@/Composables";
import { usePage } from "@inertiajs/vue3";
import { baseUrl } from "@/Helpers/baseurl";

const userStore = useUserStore();

const avatar = ref(usePage().props.auth.user.avatar);
const avatarUrl = computed(() => baseUrl(`avatar/${avatar.value}`));
</script>

<template>
    <div
        class="max-w-2xl sm:max-w-sm md:max-w-sm lg:max-w-sm xl:max-w-sm text-gray-900"
    >
        <div
            :class="[
                'mx-auto relative border-4 border-gray rounded-full overflow-hidden',
                {
                    'h-24 w-24': sidebarState.isOpen,
                    'h-10 w-10': !sidebarState.isOpen,
                },
            ]"
        >
            <img
                :class="[
                    'object-cover object-center bg-gray-200',
                    {
                        'h-24 w-24': sidebarState.isOpen,
                        'h-10 w-10': !sidebarState.isOpen,
                    },
                ]"
                :src="userStore.avatarUrl"
                alt="Avatar"
            />
        </div>
        <div class="text-center mt-2">
            <h2
                class="font-semibold dark:text-white"
                v-show="sidebarState.isOpen || sidebarState.isHovered"
            >
                {{ $page.props.auth.user.name }}
            </h2>
            <p
                class="text-gray-500 dark:text-gray-400 uppercase text-xs"
                v-show="sidebarState.isOpen || sidebarState.isHovered"
            >
                {{ $page.props.auth.user.role }}
            </p>
        </div>
    </div>
</template>
