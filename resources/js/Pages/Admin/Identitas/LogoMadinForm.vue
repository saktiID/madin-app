<script setup>
import { ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import Button from "@/Components/Button.vue";
import Label from "@/Components/Label.vue";
import Modal from "@/Components/Modal.vue";
import { baseUrl } from "@/Helpers/baseurl";
import Cropper from "vue-cropperjs";
import { useToast } from "vue-toastification";

const toast = useToast();

// logo data
const logo = usePage().props.identitas.logo_madin;
const logoUrl = baseUrl("/storage/logo/" + logo);
const currentLogo = ref(logoUrl);

// Buat ref untuk cropper
const cropperRef = ref(null);
const imageUrl = ref("");
const showModal = ref(false);
const fileInput = ref(null);

// Form untuk mengirim gambar ke backend
const form = useForm({
    logo: null, // Placeholder untuk file gambar
});

// Handle file input
const handleFileChange = (event) => {
    showModal.value = true;

    const file = event.target.files[0];
    if (file && file.type.startsWith("image/")) {
        const reader = new FileReader();
        reader.onload = (e) => {
            imageUrl.value = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        toast.info("Silakan pilih file gambar yang valid.");
    }
};

// Handle close modal
const closeModal = () => {
    showModal.value = false;
    imageUrl.value = "";
    if (fileInput.value) {
        fileInput.value.value = ""; // Reset input file
    }
};

// Crop image
const cropImage = () => {
    const cropper = cropperRef.value?.cropper;
    if (cropper) {
        const croppedCanvas = cropper.getCroppedCanvas();
        croppedCanvas.toBlob((blob) => {
            // Menyimpan gambar ke dalam form
            form.logo = blob;

            // Kirim gambar ke backend menggunakan Inertia.js
            form.post(route("admin.upload.logo"), {
                onFinish: () => {
                    closeModal();
                },
                onSuccess: () => {
                    const flash = usePage().props.flash;
                    if (flash.success) toast.success(flash.success);
                    if (flash.error) toast.error(flash.error);
                    if (flash.info) toast.info(flash.info);
                },
            });
        }, "image/png");
        currentLogo.value = croppedCanvas.toDataURL();
    }
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Pengaturan Logo Madin
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Memperbarui logo profil madin.
            </p>
        </header>

        <div class="mt-6">
            <div class="overflow-hidden h-48 w-48">
                <img
                    id="logo_madin_current"
                    class="object-cover object-center h-48 w-48"
                    :src="currentLogo"
                    alt="Logo"
                />
            </div>

            <div class="mt-6">
                <Label for="logo_madin" value="Logo Madin" />
                <input
                    ref="fileInput"
                    id="logo_madin"
                    type="file"
                    class="mt-1 block w-full cursor-pointer py-2 px-4 border border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-purple-500 file:text-white hover:file:bg-purple-600"
                    @change="handleFileChange"
                    accept="image/*"
                />
            </div>

            <!-- Cropper Component -->
            <div v-if="imageUrl">
                <Modal :show="showModal" @close="closeModal">
                    <!-- Isi modal dengan gambar untuk crop -->
                    <template #default>
                        <div class="flex justify-center p-4">
                            <Cropper
                                ref="cropperRef"
                                :src="imageUrl"
                                :aspectRatio="1"
                                style="height: 400px; width: 100%"
                            />
                        </div>
                        <div class="flex justify-end p-4 gap-2">
                            <!-- Tombol untuk mengirim gambar setelah dipotong -->
                            <Button
                                @click="cropImage"
                                :disabled="form.processing"
                                >Pangkas dan simpan</Button
                            >
                            <button
                                @click="closeModal"
                                class="bg-red-500 text-white p-2 rounded"
                            >
                                Batal
                            </button>
                        </div>
                    </template>
                </Modal>
            </div>
        </div>
    </section>
</template>
