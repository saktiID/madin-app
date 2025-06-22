import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import { baseUrl } from "@/Helpers/baseurl";
import { defineStore } from "pinia";

export const useUserStore = defineStore("user", () => {
    const page = usePage();

    const user = computed(() => page.props.auth.user);
    const avatarUrl = computed(() => baseUrl(`avatar/${user.value?.avatar}`));
    const isAdmin = computed(() => user.value?.role === "admin");

    return {
        user,
        avatarUrl,
        isAdmin,
    };
});
