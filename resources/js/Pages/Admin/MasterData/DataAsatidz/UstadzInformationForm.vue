<script setup>
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { computed } from "vue";

const toast = useToast();

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});

const ustadz = usePage().props.ustadz.ustadz;

const form = useForm({
    // id: usePage().props.ustadz.id,
    id: ustadz.id,
    no_telepon: ustadz.no_telepon,
    nik: ustadz.nik,
    alamat: ustadz.alamat,
    gender: ustadz.gender,
});

const handleSubmit = () => {
    form.patch(route("admin.master-data.data-asatidz.updateUstadz"), {
        only: ["flash"],
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

const isValidPhoneNumber = computed(() => {
    return /^08\d{8,12}$/.test(form.no_telepon);
});

const isValidNIK = computed(() => {
    return /^\d{16}$/.test(form.nik);
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Informasi Ustadz
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Perbarui informasi telepon dan alamat rumah Ustadz.
            </p>
        </header>

        <form @submit.prevent="handleSubmit" class="mt-6 space-y-6">
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
                <p v-if="!isValidPhoneNumber" class="text-red-500 text-sm mt-1">
                    Nomor telepon harus mulai dengan "08" dan memiliki 10-14
                    digit.
                </p>
                <InputError class="mt-2" :message="form.errors.no_telepon" />
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
                <InputError class="mt-2" :message="form.errors.alamat" />
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
                <InputError class="mt-2" :message="form.errors.gender" />
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
