<script setup>
import { usePage } from "@inertiajs/vue3";
import { baseUrl } from "@/Helpers/baseurl";

const logoMadin = usePage().props.madin.logo_madin;
const logoUrl = baseUrl("/storage/logo/" + logoMadin);
</script>

<template>
    <img :src="logoUrl" alt="Logo" />
</template>
