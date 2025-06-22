import { defineStore } from "pinia";
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import { baseUrl } from "@/Helpers/baseurl";

export const useMadinStore = defineStore("madin", () => {
    const page = usePage();

    const madin = computed(() => page.props.madin);

    const logoUrl = computed(() =>
        madin.value?.logo_madin
            ? baseUrl(`storage/logo/${madin.value.logo_madin}`)
            : null
    );

    return {
        madin,
        logoUrl,
    };
});
