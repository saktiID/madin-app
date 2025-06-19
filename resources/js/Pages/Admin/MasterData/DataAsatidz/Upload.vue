<script setup>
import Breadcrumb from "@/Components/Breadcrumb.vue";
import BackButton from "@/Components/BackButton.vue";
import {
    DocumentIcon,
    CloudUploadIcon,
    XCircleIcon,
} from "@heroicons/vue/outline";
import {
    UploadIcon,
    DocumentDownloadIcon,
    ShieldExclamationIcon,
} from "@heroicons/vue/solid";
import { Deferred, router, useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import ProgressBar from "@/Components/ProgressBar.vue";
import ListFile from "@/Components/ListFile.vue";
import { useToast } from "vue-toastification";
import Modal from "@/Components/Modal.vue";
import Button from "@/Components/Button.vue";
import SkeletomList from "@/Components/Skeleton/SkeletomList.vue";
import axios from "axios";

defineProps({
    files: Object,
});

const toast = useToast();
const status = ref(false);
const filename = ref(null);
const filesize = ref(null);
const showModalDelete = ref(false);

const form = useForm({
    file: null,
});
const deleteForm = useForm({
    id: null,
    filename: null,
});
const handleInputForm = (event) => {
    form.file = event.target.files[0];
    filename.value = form.file.name;
    filesize.value = (form.file.size / 1024).toFixed(2);
};
const handleResetForm = () => {
    form.file = null;
    filename.value = null;
    filesize.value = null;
};
const handleUpload = () => {
    status.value = true;

    form.post(route("admin.master-data.data-asatidz.upload-file"), {
        only: ["files", "flash", "errors"],
        preserveScroll: true,
        onSuccess: () => {
            const flash = usePage().props.flash;
            if (flash.success) {
                toast.success(flash.success);
                window.successSFX.play();
            }
            if (flash.error) {
                toast.error(flash.error);
                window.errorSFX.play();
            }
        },
        onFinish: () => {
            handleResetForm();
            status.value = false;
            const errors = usePage().props.errors;
            if (errors.length > 0) console.log(errors);
        },
        onError: () => {
            toast.error("Terjadi kesalahan");
            window.errorSFX.play();
        },
    });
};
const handleButtonDelete = (id, filename) => {
    showModalDelete.value = true;
    deleteForm.id = id;
    deleteForm.filename = filename;
};
const handleDelete = () => {
    deleteForm.delete(route("admin.master-data.data-asatidz.delete-file"), {
        preserveScroll: true,
        only: ["files", "flash", "errors"],
        onSuccess: () => {
            const flash = usePage().props.flash;
            if (flash.success) {
                toast.success(flash.success);
                window.successSFX.play();
            }
            if (flash.error) {
                toast.error(flash.error);
                window.errorSFX.play();
            }
        },
        onFinish: () => {
            closeModal();
            const errors = usePage().props.errors;
            if (errors.length > 0) console.log(errors);
        },
        onError: () => {
            toast.error("Terjadi kesalahan");
            window.errorSFX.play();
        },
    });
};
const closeModal = () => {
    deleteForm.reset();
    showModalDelete.value = false;
};

//
const parsing = ref(null);
const progress = ref(5);
const handleParsing = async (id, filename) => {
    parsing.value = id;

    try {
        await axios.get(route("admin.master-data.data-asatidz.parsing"), {
            params: { id, filename },
        });

        reload();

        toast.success("Parsing selesai");
        window.successSFX.play();
    } catch (error) {
        reload();
        console.error("Gagal trigger parsing:", error);
        toast.error("Terjadi kesalahan");
        window.errorSFX.play();
    }

    const interval = setInterval(async () => {
        try {
            const res = await axios.get(
                route("admin.master-data.data-asatidz.polling"),
                { params: { id } }
            );
            progress.value = res.data.progress;

            if (progress.value === 100) {
                clearInterval(interval);
                parsing.value = null;
            }
        } catch (error) {
            console.error("Polling gagal:", error);
            clearInterval(interval);
            parsing.value = null;
        }
    }, 100);
};

const reload = () => {
    parsing.value = null;
    progress.value = 0;
    router.visit(route("admin.master-data.data-asatidz.upload"), {
        method: "get",
        only: ["files"],
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Upload Data" />

    <!-- breadcrumb -->
    <div class="py-4">
        <Breadcrumb
            :paths="[
                { name: 'Master Data', url: '#' },
                {
                    name: 'Data Asatidz',
                    url: route('admin.master-data.data-asatidz.index'),
                },
                {
                    name: 'Upload',
                    url: '#',
                },
            ]"
        />
    </div>

    <!-- heading -->
    <div class="py-4">
        <div
            class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between"
        >
            <BackButton
                href="admin.master-data.data-asatidz.index"
                header-teks="Upload Data"
            />
        </div>
    </div>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <header>
                <h2
                    class="text-lg font-medium text-gray-900 dark:text-gray-100"
                >
                    Upload Data Asatidz
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Meng-upload file data Asatidz.
                </p>
            </header>

            <section class="max-w-xl">
                <div class="my-3">
                    <div
                        id="alert-additional-content-4"
                        class="p-4 mb-4 text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
                        role="alert"
                    >
                        <div class="flex items-center">
                            <ShieldExclamationIcon class="w-5 h-5 me-2" />
                            <span class="sr-only">Info</span>
                            <h3 class="text-lg text-sm">Peringatan!</h3>
                        </div>
                        <div class="mt-2 mb-4 text-xs">
                            Agar proses memasukkan data lancar dan aman, tidak
                            diperkenankan membuat atau memodifikasi template.
                            Pastikan file yang di-upload berasal dari aplikasi
                            ini!
                        </div>
                        <div class="flex">
                            <a
                                :href="
                                    route(
                                        'admin.master-data.data-asatidz.download-template'
                                    )
                                "
                                type="button"
                                class="text-white bg-yellow-800 hover:bg-yellow-900 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center dark:bg-yellow-300 dark:text-gray-800 dark:hover:bg-yellow-400 dark:focus:ring-yellow-800"
                            >
                                <DocumentDownloadIcon class="w-4 h-4 me-2" />
                                Download template
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <form @submit.prevent="handleUpload">
                <!-- dropzone -->
                <section v-if="!form.file && !status" class="max-w-xl">
                    <div class="flex items-center justify-center w-full">
                        <label
                            for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                        >
                            <div
                                class="flex flex-col items-center justify-center pt-5 pb-6"
                            >
                                <CloudUploadIcon
                                    class="w-10 h-10 mb-4 text-gray-500 dark:text-gray-400"
                                />
                                <p
                                    class="mb-2 text-sm text-gray-500 dark:text-gray-400"
                                >
                                    <span class="font-semibold"
                                        >Klik untuk upload</span
                                    >
                                    atau seret dan jatuhkan
                                </p>
                                <p
                                    class="text-xs text-gray-500 dark:text-gray-400"
                                >
                                    XLS, XLSX (Maks. 3072kB)
                                </p>
                            </div>
                            <input
                                id="dropzone-file"
                                type="file"
                                class="hidden"
                                @input="handleInputForm($event)"
                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                            />
                        </label>
                    </div>
                </section>

                <!-- staging area -->
                <section v-if="form.file && !status" class="max-w-xl">
                    <div
                        class="flex flex-col items-center justify-center block w-full h-48 p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700"
                    >
                        <DocumentIcon
                            class="w-10 h-10 text-gray-500 dark:text-gray-400"
                        />
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ filename }} ({{ filesize }}kB)
                        </p>
                        <div class="my-3 text-center">
                            <button
                                type="submit"
                                class="text-white bg-yellow-800 hover:bg-yellow-900 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center dark:bg-yellow-300 dark:text-gray-800 dark:hover:bg-yellow-400 dark:focus:ring-yellow-800"
                            >
                                <UploadIcon class="w-4 h-4 me-2" />
                                Upload
                            </button>
                            <button
                                @click="handleResetForm"
                                type="button"
                                class="text-white bg-yellow-800 hover:bg-yellow-900 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center dark:bg-yellow-300 dark:text-gray-800 dark:hover:bg-yellow-400 dark:focus:ring-yellow-800"
                            >
                                <XCircleIcon class="w-4 h-4 me-2" />
                                Hapus
                            </button>
                        </div>
                        <p
                            class="text-xs italic text-center text-gray-500 dark:text-gray-400"
                        >
                            Upload hanya mengirim file ke penyimpanan server
                            pilih parsing pada file tersimpan untuk memasukkan
                            data ke dalam database.
                        </p>
                    </div>
                </section>
            </form>

            <!-- progress -->
            <section v-if="status && form.progress" class="max-w-xl">
                <div
                    class="w-full h-48 p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 flex items-center"
                >
                    <ProgressBar
                        progress-name="Progres upload"
                        :progress-percentage="form.progress.percentage"
                        variant="warning"
                        class="w-full"
                    />
                </div>
            </section>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <header>
                <h2
                    class="text-lg font-medium text-gray-900 dark:text-gray-100"
                >
                    File Tersimpan
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Beberapa file yang sudah ada di penyimpanan. <br />
                    File tersimpan secara privat dan hanya admin yang dapat
                    melihat.
                </p>
            </header>

            <!-- list file -->
            <section class="max-w-xl">
                <ul
                    class="my-3 w-full divide-y divide-gray-200 dark:divide-gray-700"
                >
                    <Deferred :data="['files']">
                        <template #fallback><SkeletomList /> </template>

                        <ListFile
                            v-for="(item, index) in files"
                            :key="index"
                            :filename="item.filename"
                            :filedate="item.created_at"
                            :filesize="item.filesize"
                            :is-imported="item.is_imported"
                            :log="item.log"
                            @click-parsing="
                                handleParsing(item.id, item.filename)
                            "
                            @click-delete="
                                handleButtonDelete(item.id, item.filename)
                            "
                            :disabled="parsing != null"
                        >
                            <div v-if="parsing === item.id">
                                <ProgressBar
                                    progress-name="Parsing template"
                                    :progress-percentage="progress"
                                    variant="warning"
                                />
                            </div>
                            <div v-if="item.log">
                                <p class="text-yellow-400 text-xs truncate">
                                    Log: <span v-html="item.log"></span>
                                </p>
                            </div>
                        </ListFile>

                        <!-- no file saved -->
                        <li v-if="files.length == 0" class="py-3 sm:pb-4">
                            <div
                                class="flex flex-col items-center justify-center space-x-4 rtl:space-x-reverse"
                            >
                                <img
                                    src="/storage/img/no-result.png"
                                    class="m-auto"
                                    width="150"
                                    alt="no result"
                                />
                                <p class="text-gray-500 text-sm">
                                    Tidak ada file tersimpan
                                </p>
                            </div>
                        </li>
                    </Deferred>
                </ul>
            </section>
        </div>
    </div>

    <Modal :show="showModalDelete" @close="closeModal">
        <template #default>
            <div class="p-4">
                <h3
                    class="text-lg font-medium text-gray-900 dark:text-gray-100"
                >
                    Hapus file
                </h3>

                <ol
                    class="list-decimal pl-5 mt-2 text-gray-700 dark:text-gray-300"
                >
                    <li class="text-sm text-gray-700 dark:text-gray-300">
                        {{ deleteForm.filename }}
                    </li>
                </ol>

                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Apakah Anda yakin ingin menghapus file ini dari
                    penyimpanan?? Tindakan ini tidak dapat dibatalkan.
                </p>

                <div class="flex justify-end p-4 gap-2">
                    <!-- Tombol untuk mengirim gambar setelah dipotong -->
                    <Button variant="secondary" @click="closeModal">
                        Batal
                    </Button>
                    <Button
                        variant="danger"
                        @click="handleDelete"
                        :disabled="deleteForm.processing"
                    >
                        {{ deleteForm.processing ? "Menghapus" : "Hapus" }}
                    </Button>
                </div>
            </div>
        </template>
    </Modal>
</template>
