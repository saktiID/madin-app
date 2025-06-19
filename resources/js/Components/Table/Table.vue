<script setup>
import { PlusIcon, TrashIcon } from "@heroicons/vue/outline";
import { SearchIcon } from "@/Components/Icons/solid";
import { ChevronDownIcon } from "@heroicons/vue/solid";
import { Link } from "@inertiajs/vue3";

import Dropdown from "@/Components/Dropdown.vue";

defineProps({
    showDeleteButton: {
        type: Boolean,
        default: true,
    },
    createLink: {
        type: String,
        default: "#",
    },
});

const model = defineModel({ type: String });
const emit = defineEmits(["clickDelete"]);
const clickDelete = () => emit("clickDelete");
</script>

<template>
    <div class="relative">
        <div
            class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4"
        >
            <div class="gap-2 flex flex-wrap items-center">
                <Dropdown
                    align="left"
                    contentClasses="z-10 divide-y divide-gray-500 rounded-lg shadow-md w-44 dark:bg-gray-700 bg-white absolute "
                >
                    <template #trigger>
                        <span class="inline-flex rounded-md">
                            <button
                                type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                <PlusIcon class="w-5 h-5 me-2" />
                                Tambah Data
                                <ChevronDownIcon class="w-4 h-4 ms-2" />
                            </button>
                        </span>
                    </template>
                    <template #content>
                        <ul
                            class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownDefaultButton"
                        >
                            <li>
                                <Link
                                    :href="createLink"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    >Tambah Manual</Link
                                >
                            </li>
                            <li>
                                <Link
                                    :href="
                                        route(
                                            'admin.master-data.data-asatidz.upload'
                                        )
                                    "
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    >Upload Excel</Link
                                >
                            </li>
                        </ul>
                    </template>
                </Dropdown>

                <button
                    v-if="showDeleteButton"
                    @click="clickDelete"
                    type="button"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 dark:bg-red-600 dark:hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800"
                >
                    <TrashIcon class="w-5 h-5 me-2" />
                    Hapus Data
                </button>
            </div>

            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div
                    class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none"
                >
                    <SearchIcon />
                </div>
                <input
                    type="search"
                    id="table-search"
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg md:w-80 w-50 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cari data"
                    v-model="model"
                />
            </div>
        </div>
        <div class="rounded-lg overflow-x-auto overflow-hidden">
            <table
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            >
                <slot name="thead"></slot>
                <slot name="tbody"></slot>
            </table>
        </div>
    </div>

    <div
        class="flex flex-col md:flex-row items-center md:justify-between justify-center"
    >
        <div class="mt-4">
            <div class="flex items-center space-x-2">
                <slot name="pagination-info"></slot>
            </div>
        </div>

        <nav aria-label="Table navigation">
            <ul class="flex items-center -space-x-px text-base flex-wrap mt-4">
                <slot name="pagination-links"></slot>
            </ul>
        </nav>
    </div>
</template>
