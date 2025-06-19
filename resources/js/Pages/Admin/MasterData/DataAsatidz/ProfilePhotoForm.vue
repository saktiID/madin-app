<script setup>
import { ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import Button from "@/Components/Button.vue";
import Label from "@/Components/Label.vue";
import Modal from "@/Components/Modal.vue";
import { baseUrl } from "@/Helpers/baseurl";
import Cropper from "vue-cropperjs";
import { useToast } from "vue-toastification";
import InputError from "@/Components/InputError.vue";

const toast = useToast();

// photo data
const avatar = usePage().props.ustadz.avatar;
const avatarUrl = baseUrl(`avatar/${avatar}`);
const currentAvatar = ref(avatarUrl);

// Buat ref untuk cropper
const cropperRef = ref(null);
const imageUrl = ref("");
const showModal = ref(false);
const fileInput = ref(null);

// Form untuk mengirim gambar ke backend
const form = useForm({
    avatar: null, // Placeholder untuk file gambar
    id: usePage().props.ustadz.id, // ID ustadz untuk mengirim data
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
            form.avatar = blob;

            // Kirim gambar ke backend menggunakan Inertia.js
            form.post(route("admin.master-data.data-asatidz.updateAvatar"), {
                onFinish: () => {
                    closeModal();
                    if (form.hasErrors) {
                        toast.error("Ada kesalahan dalam pengisian form.");
                        window.errorSFX.play();
                    }
                },
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
                onError: () => {
                    toast.error("Terjadi kesalahan");
                    window.errorSFX.play();
                },
            });
        }, "image/png");
        currentAvatar.value = croppedCanvas.toDataURL();
    }
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Foto Profil
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Memperbarui foto profil.
            </p>
        </header>

        <div class="mt-6">
            <div class="overflow-hidden h-48 w-48">
                <img
                    id="avatar_current"
                    class="object-cover object-center h-48 w-48 bg-gray-200 rounded-md border-4 border-gray"
                    :src="currentAvatar"
                    alt="Avatar"
                />
            </div>

            <div class="mt-6">
                <Label for="avatar" value="Pilih foto" />
                <input
                    ref="fileInput"
                    id="avatar"
                    type="file"
                    class="mt-1 block w-full cursor-pointer py-2 px-4 border border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-purple-500 file:text-white hover:file:bg-purple-600"
                    @change="handleFileChange"
                    accept="image/*"
                />
                <InputError class="mt-2" :message="form.errors.avatar" />
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
                        <div class="p-4">
                            <div
                                v-if="form.progress"
                                class="flex justify-between mb-1"
                            >
                                <span
                                    class="text-base font-medium text-blue-700 dark:text-white"
                                    >Uploading</span
                                >
                                <span
                                    class="text-sm font-medium text-blue-700 dark:text-white"
                                    >{{ form.progress.percentage }}%</span
                                >
                            </div>
                            <div
                                v-if="form.progress"
                                class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700"
                            >
                                <div
                                    class="bg-blue-600 h-1.5 rounded-full"
                                    :style="`width: ${form.progress.percentage}%`"
                                ></div>
                            </div>
                        </div>

                        <div class="flex justify-end p-4 gap-2">
                            <!-- Tombol untuk mengirim gambar setelah dipotong -->
                            <Button variant="secondary" @click="closeModal">
                                Batal
                            </Button>
                            <Button
                                @click="cropImage"
                                :disabled="form.processing"
                                >{{
                                    form.processing
                                        ? "Menyimpan..."
                                        : "Pangkas dan simpan"
                                }}</Button
                            >
                        </div>
                    </template>
                </Modal>
            </div>
        </div>
    </section>
</template>
