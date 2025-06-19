<script setup>
import { usePage, Deferred, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import { debounce } from "lodash";
import { baseUrl } from "@/Helpers/baseurl";

import Modal from "@/Components/Modal.vue";
import Button from "@/Components/Button.vue";
import Table from "@/Components/Table/Table.vue";
import TableHead from "@/Components/Table/TableHead.vue";
import TableRow from "@/Components/Table/TableRow.vue";
import TableNoResult from "@/Components/Table/TableNoResult.vue";
import TablePaginationInfo from "@/Components/Table/TablePaginationInfo.vue";
import TablePaginationLinks from "@/Components/Table/TablePaginationLinks.vue";
import TableLoading from "@/Components/Table/TableLoading.vue";
import TableDataCheck from "@/Components/Table/TableDataCheck.vue";
import SkeletonTable from "@/Components/Skeleton/SkeletonTable.vue";
import { TrashIcon, PencilAltIcon } from "@heroicons/vue/outline";

import { useHandleDelete } from "@/Composables/useHandleDelete";
import { useHandleCheckbox } from "@/Composables/useHandleCheckbox";
import { useDeleteStore } from "@/Stores/useDeleteStore";
import { useIsDeleted } from "@/Composables/useIsDeleted";

const deleteStore = useDeleteStore();
const params = new URLSearchParams(window.location.search);
const search = ref(params.get("search") || "");
const perpage = ref(params.get("perpage") || 10);
const { isDeleted } = useIsDeleted();
const { handleCheckboxChecked, handleCheckboxAll } = useHandleCheckbox();
const {
    handleSingleDeleteButton,
    handleMultipleDeleteButton,
    handleDelete,
    closeModal,
} = useHandleDelete({
    nameProperty: "nama",
    deletePath: "admin.master-data.data-santri.delete",
    only: ["santri", "flash"],
});

defineProps({
    santri: Object,
});

watch(
    [search, perpage],
    debounce(
        (q) =>
            router.get(
                route("admin.master-data.data-santri.index"),
                { search: q[0], perpage: q[1] },
                {
                    only: ["santri"],
                    preserveState: true,
                    preserveScroll: true,
                    onStart: () => {
                        deleteStore.setIsLoading();
                    },
                    onFinish: () => {
                        deleteStore.setIsLoading();
                    },
                    onError: (error) => {
                        console.error("Kesalahan:", error);
                        deleteStore.setIsLoading();
                    },
                }
            ),
        300
    )
);

isDeleted();
</script>

<template>
    <Head title="Data Santri" />
    <!-- breadcrumb -->
    <div class="py-4">
        <Breadcrumb
            :paths="[
                { name: 'Master Data', url: '#' },
                {
                    name: 'Data Santri',
                    url: route('admin.master-data.data-santri.index'),
                },
            ]"
        />
    </div>

    <!-- heading -->
    <div class="py-4">
        <div
            class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between"
        >
            <h2 class="text-xl font-semibold leading-tight">Data Santri</h2>
        </div>
    </div>

    <Table
        v-model="search"
        :showDeleteButton="deleteStore.showDeleteButton"
        :create-link="route('admin.master-data.data-asatidz.create')"
        @clickDelete="handleMultipleDeleteButton(usePage().props.santri)"
    >
        <template #thead>
            <TableHead
                :columns="['Data Santri']"
                :with-checkbox="true"
                :with-action="true"
                @checkAll="handleCheckboxAll"
            />
        </template>

        <template #tbody>
            <tbody class="relative">
                <TableLoading v-if="deleteStore.isLoading" />
                <Deferred :data="['santri']">
                    <template #fallback>
                        <SkeletonTable />
                    </template>

                    <TableRow v-for="(item, index) in santri.data" :key="index">
                        <TableDataCheck
                            :id="item.id"
                            @check="handleCheckboxChecked"
                        />
                        <td>
                            <Link
                                class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white"
                                :href="
                                    route(
                                        'admin.master-data.data-asatidz.edit',
                                        item.id
                                    )
                                "
                            >
                                <img
                                    class="w-10 h-10 rounded-full bg-gray-200"
                                    :src="baseUrl(`avatar/${item.avatar}`)"
                                    alt="Avatar"
                                />
                                <div class="ps-3">
                                    <div
                                        class="text-base font-semibold hover:underline"
                                    >
                                        {{ item.nama }}
                                    </div>
                                    <div class="font-normal text-gray-500">
                                        NIS: {{ item.nis }}
                                    </div>
                                </div>
                            </Link>
                        </td>
                        <td class="px-6 py-4">
                            <div
                                class="flex rounded-md justify-end"
                                role="group"
                            >
                                <Link
                                    :href="
                                        route(
                                            'admin.master-data.data-asatidz.edit',
                                            item.id
                                        )
                                    "
                                    type="button"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white"
                                >
                                    <PencilAltIcon class="w-5 h-5 me-2" />
                                    Edit
                                </Link>

                                <button
                                    @click="
                                        handleSingleDeleteButton(
                                            item.id,
                                            item.nama
                                        )
                                    "
                                    type="button"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border-s border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white"
                                >
                                    <TrashIcon class="w-5 h-5 me-2" />
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </TableRow>
                    <TableNoResult
                        :colspan="3"
                        v-if="santri.data.length == 0"
                    />
                </Deferred>
            </tbody>
        </template>

        <template #pagination-info>
            <Deferred :data="['santri']">
                <template #fallback> </template>
                <TablePaginationInfo :data="santri" v-model="perpage" />
            </Deferred>
        </template>

        <template #pagination-links>
            <Deferred :data="['santri']">
                <template #fallback> </template>
                <TablePaginationLinks :data="santri" :only="['santri']" />
            </Deferred>
        </template>
    </Table>

    <Modal :show="deleteStore.showModalDelete" @close="closeModal">
        <template #default>
            <div class="p-4">
                <h3
                    class="text-lg font-medium text-gray-900 dark:text-gray-100"
                >
                    Hapus Data Santri
                </h3>

                <ol
                    class="list-decimal pl-5 mt-2 text-gray-700 dark:text-gray-300"
                >
                    <li
                        v-for="(name, index) in deleteStore.deleteName"
                        :key="index"
                        class="text-sm text-gray-700 dark:text-gray-300"
                    >
                        {{ name }}
                    </li>
                </ol>

                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Apakah Anda yakin ingin menghapus data santri ini? Tindakan
                    ini tidak dapat dibatalkan.
                </p>
            </div>

            <div class="flex justify-end p-4 gap-2">
                <!-- Tombol untuk mengirim gambar setelah dipotong -->
                <Button variant="secondary" @click="closeModal"> Batal </Button>
                <Button
                    variant="danger"
                    @click="handleDelete"
                    :disabled="deleteStore.form.processing"
                    >{{
                        deleteStore.form.processing ? "Menghapus..." : "Hapus"
                    }}</Button
                >
            </div>
        </template>
    </Modal>
</template>
