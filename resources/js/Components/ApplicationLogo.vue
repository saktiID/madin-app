<script setup>
import { useMadinStore } from "@/Stores/useMadinStore";

const madinStore = useMadinStore();
</script>

<template>
    <img :src="madinStore.logoUrl" alt="Logo" />
</template>
