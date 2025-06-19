<script setup>
defineProps({
    data: Object,
});
const model = defineModel({ type: [Number, String] });
</script>

<template>
    <select
        v-model="model"
        id="countries"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
    >
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
    </select>
    <span class="text-sm text-gray-700 dark:text-gray-400 w-full">
        Data {{ data.from }} - {{ data.to }} <br />
        {{ data.per_page }} dari {{ data.total }} data ditampilkan
    </span>
</template>
