<script setup>
import { ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import Label from "@/Components/Label.vue";
import Input from "@/Components/Input.vue";
import InputError from "@/Components/InputError.vue";
import Button from "@/Components/Button.vue";
import { useToast } from "vue-toastification";

const toast = useToast();
const passwordInput = ref(null);

const form = useForm({
    id: usePage().props.ustadz.id,
    password: "",
    password_confirmation: "",
});

const updatePassword = () => {
    form.patch(route("admin.master-data.data-asatidz.updatePassword"), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
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
        onFinish: () => {
            if (form.errors.password) {
                form.reset("password", "password_confirmation");
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset("current_password");
                currentPasswordInput.value.focus();
            }
            if (form.hasErrors) {
                toast.error("Ada kesalahan dalam pengisian form.");
                window.errorSFX.play();
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Perbarui Password
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Pastikan akun Ustadz menggunakan kata sandi yang panjang dan
                acak untuk tetap aman.
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
            <div>
                <Label for="password" value="Password Baru" />

                <Input
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="new-password"
                />

                <InputError :message="form.errors.password" class="mt-2" />
            </div>

            <div>
                <Label
                    for="password_confirmation"
                    value="Konfirmasi Password"
                />

                <Input
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="new-password"
                />

                <InputError
                    :message="form.errors.password_confirmation"
                    class="mt-2"
                />
            </div>

            <div class="flex items-center gap-4">
                <Button :disabled="form.processing">Menyimpan</Button>

                <Transition
                    enter-from-class="opacity-0"
                    leave-to-class="opacity-0"
                    class="transition ease-in-out"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >
                        Tersimpan.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
