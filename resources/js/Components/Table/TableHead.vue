<script setup>
defineProps({
    columns: Array,
    withCheckbox: {
        type: Boolean,
        default: false,
    },
    withAction: {
        type: Boolean,
        default: false,
    },
});
const emit = defineEmits(["checkAll"]);
const checkAll = (event) => emit("checkAll", event);
</script>

<template>
    <thead
        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
    >
        <tr>
            <th scope="col" class="p-4 relative">
                <div v-if="withCheckbox" class="flex items-center">
                    <input
                        id="checkbox-all-search"
                        type="checkbox"
                        @change="checkAll"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                    />
                    <label
                        for="checkbox-all-search"
                        class="absolute inset-0"
                    ></label>
                </div>
            </th>

            <th
                v-for="(col, index) in columns"
                :key="index"
                scope="col"
                class="px-6 py-3"
            >
                <span
                    class="hover:cursor-pointer hover:text-black hover:dark:text-white"
                >
                    {{ col }}
                </span>
            </th>
            <th v-if="withAction"></th>
        </tr>
    </thead>
</template>
