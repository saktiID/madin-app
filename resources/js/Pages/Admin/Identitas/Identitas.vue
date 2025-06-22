<script setup>
import IdentitasForm from "./IdentitasForm.vue";
import LogoMadinForm from "./LogoMadinForm.vue";
</script>

<template>
    <Head title="Identitas" />

    <!-- breadcrumb -->
    <div class="py-4">
        <Breadcrumb :paths="[{ name: 'Identitas', url: '#' }]" />
    </div>

    <!-- heading -->
    <div class="py-4">
        <div
            class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between"
        >
            <h2 class="text-xl font-semibold leading-tight">Identitas</h2>
        </div>
    </div>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <LogoMadinForm class="max-w-xl" />
        </div>
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <IdentitasForm class="max-w-xl" />
        </div>
    </div>
</template>
