<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { computed } from "vue";
import Label from "@/Components/Label.vue";
import Input from "@/Components/Input.vue";
import InputError from "@/Components/InputError.vue";
import Button from "@/Components/Button.vue";
import BackButton from "@/Components/BackButton.vue";

const toast = useToast();

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    no_telepon: "",
    nik: "",
    alamat: "",
    gender: "",
});

const isValidPhoneNumber = computed(() => {
    return /^08\d{8,12}$/.test(form.no_telepon);
});

const isValidNIK = computed(() => {
    return /^\d{16}$/.test(form.nik);
});

const handleSubmit = () => {
    form.post(route("admin.master-data.data-asatidz.store"), {
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
            form.reset();
        },
        onFinish: () => {
            if (form.hasErrors) {
                toast.error("Ada kesalahan dalam pengisian form.");
                window.errorSFX.play();
            }
        },
        onError: () => {
            toast.error("Terjadi kesalahan");
            window.errorSFX.play();
        },
    });
};
</script>

<template>
    <Head title="Tambah Data Asatidz" />

    <!-- breadcrumb -->
    <div class="py-4">
        <Breadcrumb
            :paths="[
                { name: 'Master Data', url: '#' },
                {
                    name: 'Data Asatidz',
                    url: route('admin.master-data.data-asatidz.index'),
                },
                { name: 'Tambah', url: '#' },
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
                header-teks="Tambah Data Asatidz"
            />
        </div>
    </div>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <section class="max-w-xl">
                <form @submit.prevent="handleSubmit" class="space-y-6">
                    <header>
                        <h2
                            class="text-lg font-medium text-gray-900 dark:text-gray-100"
                        >
                            Informasi Profil
                        </h2>

                        <p
                            class="mt-1 text-sm text-gray-600 dark:text-gray-400"
                        >
                            Buat informasi profil dan alamat email akun Ustadz.
                        </p>
                    </header>

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

                    <header>
                        <h2
                            class="text-lg font-medium text-gray-900 dark:text-gray-100"
                        >
                            Buat Password
                        </h2>

                        <p
                            class="mt-1 text-sm text-gray-600 dark:text-gray-400"
                        >
                            Pastikan akun Ustadz menggunakan kata sandi yang
                            panjang dan acak untuk tetap aman.
                        </p>
                    </header>

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

                        <InputError
                            :message="form.errors.password"
                            class="mt-2"
                        />
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

                    <header>
                        <h2
                            class="text-lg font-medium text-gray-900 dark:text-gray-100"
                        >
                            Informasi Ustadz
                        </h2>

                        <p
                            class="mt-1 text-sm text-gray-600 dark:text-gray-400"
                        >
                            Perbarui informasi telepon dan alamat rumah Ustadz.
                        </p>
                    </header>

                    <div>
                        <Label for="no_telepon" value="Telepon" />

                        <Input
                            id="no_telepon"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.no_telepon"
                            required
                            autocomplete="no_telepon"
                        />
                        <p
                            v-if="!isValidPhoneNumber"
                            class="text-red-500 text-sm mt-1"
                        >
                            Nomor telepon harus mulai dengan "08" dan memiliki
                            10-14 digit.
                        </p>
                        <InputError
                            class="mt-2"
                            :message="form.errors.no_telepon"
                        />
                    </div>

                    <div>
                        <Label for="nik" value="NIK" />

                        <Input
                            id="nik"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.nik"
                            required
                            autocomplete="nik"
                        />
                        <p v-if="!isValidNIK" class="text-red-500 text-sm mt-1">
                            NIK harus terdiri dari 16 digit angka.
                        </p>
                        <InputError class="mt-2" :message="form.errors.nik" />
                    </div>

                    <div>
                        <Label for="alamat" value="Alamat" />

                        <Input
                            id="alamat"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.alamat"
                            required
                            autocomplete="alamat"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.alamat"
                        />
                    </div>

                    <div>
                        <Label for="gender" value="Gender" />
                        <div class="mt-1 block w-full">
                            <label class="inline-flex items-center">
                                <input
                                    type="radio"
                                    v-model="form.gender"
                                    value="L"
                                    :checked="form.gender === 'L'"
                                    class="border-gray-300 text-blue-500 focus:ring-blue-500"
                                />
                                <span class="ml-2">Laki-laki</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input
                                    type="radio"
                                    v-model="form.gender"
                                    value="P"
                                    :checked="form.gender === 'P'"
                                    class="border-gray-300 text-blue-500 focus:ring-blue-500"
                                />
                                <span class="ml-2">Perempuan</span>
                            </label>
                        </div>
                        <InputError
                            class="mt-2"
                            :message="form.errors.gender"
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
        </div>
    </div>
</template>
