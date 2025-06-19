<script setup>
import { nextTick, ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import Button from "@/Components/Button.vue";

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    id: [usePage().props.ustadz.id],
    editing: true,
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    // nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route("admin.master-data.data-asatidz.delete"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Hapus Akun
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Setelah akun Ustadz dihapus, semua sumber daya dan data yang
                terkait akan dihapus secara permanen. Sebelum menghapus akun
                Ustadz, harap unduh data atau informasi yang ingin Anda simpan.
            </p>
        </header>

        <Button variant="danger" @click="confirmUserDeletion">
            Hapus Akun
        </Button>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2
                    class="text-lg font-medium text-gray-900 dark:text-gray-100"
                >
                    Apakah Anda yakin ingin menghapus akun Anda?
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Setelah akun Ustadz dihapus, semua sumber daya dan data yang
                    terkait akan dihapus secara permanen. Harap masukkan kata
                    sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus
                    akun Ustadz secara permanen.
                </p>

                <div class="mt-6 flex justify-end">
                    <Button variant="secondary" @click="closeModal">
                        Batal
                    </Button>

                    <Button
                        variant="danger"
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        {{ form.processing ? "Menghapus..." : "Hapus Akun" }}
                    </Button>
                </div>
            </div>
        </Modal>
    </section>
</template>
