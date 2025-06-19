<script setup>
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const toast = useToast();

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});

const handleSubmit = () => {
    form.patch(route("profile.update"), {
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
        onError: () => {
            toast.error("Terjadi kesalahan");
            window.errorSFX.play();
        },
        onFinish: () => {
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
                Informasi Profil
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Perbarui informasi profil dan alamat email akun Anda.
            </p>
        </header>

        <form @submit.prevent="handleSubmit" class="mt-6 space-y-6">
            <div>
                <Label for="name" value="Nama" />

                <Input
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <Label for="email" value="Email" />

                <Input
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="email"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div
                v-if="props.mustVerifyEmail && user.email_verified_at === null"
            >
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="props.status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600 dark:text-green-400"
                >
                    A new verification link has been sent to your email address.
                </div>
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
