<script setup>
import { useToast } from "vue-toastification";
import { usePage } from "@inertiajs/vue3";

const toast = useToast();
const flash = usePage().props.flash;
if (flash.success) {
    toast.success(flash.success);
    window.successSFX.play();
}
if (flash.error) {
    toast.error(flash.error);
    window.errorSFX.play();
}
</script>

<template>
    <Head title="Dashboard" />

    <!-- breadcrumb -->
    <div class="py-4">
        <Breadcrumb :paths="[{ name: 'Dashboard', url: route('dashboard') }]" />
    </div>

    <!-- heading -->
    <div class="py-4">
        <div
            class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between"
        >
            <h2 class="text-xl font-semibold leading-tight">Dashboard</h2>
        </div>
    </div>

    <div class="grid grid-rows-5 sm:grid-rows-3 grid-flow-col gap-4 leading-10">
        <div
            class="p-4 w-full bg-white shadow-md dark:bg-dark-eval-1 rounded-md sm:row-span-3"
        >
            Identitas
        </div>
        <div
            class="p-4 w-full bg-white shadow-md dark:bg-dark-eval-1 rounded-md sm:col-span-3"
        >
            Periode
        </div>
        <div
            class="p-4 w-full bg-white shadow-md dark:bg-dark-eval-1 rounded-md sm:row-span-2"
        >
            Asatidz
        </div>
        <div
            class="p-4 w-full bg-white shadow-md dark:bg-dark-eval-1 rounded-md sm:row-span-2"
        >
            Santri
        </div>
        <div
            class="p-4 w-full bg-white shadow-md dark:bg-dark-eval-1 rounded-md sm:row-span-2"
        >
            Kitab
        </div>
    </div>
</template>
