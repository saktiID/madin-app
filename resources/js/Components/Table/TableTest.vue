<script setup>
import { ref, watch, computed } from "vue";
import { router, usePage, Deferred } from "@inertiajs/vue3";

const props = defineProps({
    data: Object,
    columns: Array,
    searchQuery: String,
});

const search = ref(props.searchQuery ?? "");

watch(search, (value) => {
    router.get(
        route("admin.master-data.data-asatidz"),
        { search: value },
        { preserveState: true }
    );
});
</script>

<template>
    <div class="mb-4">
        <input
            v-model="search"
            type="text"
            placeholder="Cari data..."
            class="border p-2 rounded w-full"
        />
    </div>

    <table class="w-full border-collapse border">
        <thead>
            <tr>
                <th
                    v-for="col in props.columns"
                    :key="col"
                    class="border p-2 text-left"
                >
                    {{ col }}
                </th>
            </tr>
        </thead>
        <tbody>
            <Deferred :data="[props.data]">
                <template #fallback>
                    <!-- Skeleton Loader -->
                    <tr v-for="i in 10" :key="i">
                        <td class="animate-pulse bg-gray-200 p-4">
                            Loading...
                        </td>
                        <td class="animate-pulse bg-gray-200 p-4">
                            Loading...
                        </td>
                    </tr>
                </template>
                <tr v-for="item in props.data.data" :key="item.id">
                    <td>{{ item.name }}</td>
                    <td>{{ item.email }}</td>
                </tr>
            </Deferred>
        </tbody>
    </table>

    <div class="mt-4 flex justify-between"></div>
</template>
