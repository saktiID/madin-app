<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import Label from "@/Components/Label.vue";
import Input from "@/Components/Input.vue";
import InputError from "@/Components/InputError.vue";
import Button from "@/Components/Button.vue";
import { useToast } from "vue-toastification";

const toast = useToast();

const identitas = usePage().props.identitas;

const form = useForm({
    nama_madin: identitas.nama_madin,
    alamat_madin: identitas.alamat_madin,
    kota_madin: identitas.kota_madin,
    kode_pos_madin: identitas.kode_pos_madin,
    telepon_madin: identitas.telepon_madin,
    email_madin: identitas.email_madin,
    nomor_statistik_madin: identitas.nomor_statistik_madin,
    kepala_madin: identitas.kepala_madin,
    bendahara_madin: identitas.bendahara_madin,
    sekretaris_madin: identitas.sekretaris_madin,
});

const handleSubmit = () => {
    form.patch(route("admin.identitas.update"), {
        preserveScroll: true,
        onSuccess: () => {
            const flash = usePage().props.flash;
            if (flash.success) toast.success(flash.success);
            if (flash.error) toast.error(flash.error);
            if (flash.info) toast.info(flash.info);
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Pengaturan Identitas Madin
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Memperbarui informasi identitas madin dan alamat madin.
            </p>
        </header>

        <form @submit.prevent="handleSubmit" class="mt-6 space-y-6">
            <div>
                <Label for="nama_madin" value="Nama Madin" />

                <Input
                    id="nama_madin"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.nama_madin"
                    required
                    autocomplete="nama_madin"
                />

                <InputError class="mt-2" :message="form.errors.nama_madin" />
            </div>

            <div>
                <Label for="alamat_madin" value="Alamat Madin" />

                <Input
                    id="alamat_madin"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.alamat_madin"
                    required
                    autocomplete="alamat_madin"
                />

                <InputError class="mt-2" :message="form.errors.nama_madin" />
            </div>

            <div>
                <Label for="kota_madin" value="Kota Madin" />

                <Input
                    id="kota_madin"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.kota_madin"
                    required
                    autocomplete="kota_madin"
                />

                <InputError class="mt-2" :message="form.errors.kota_madin" />
            </div>
            <div>
                <Label for="kode_pos_madin" value="Kode Pos Madin" />

                <Input
                    id="kode_pos_madin"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.kode_pos_madin"
                    required
                    autocomplete="kode_pos_madin"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.kode_pos_madin"
                />
            </div>
            <div>
                <Label for="telepon_madin" value="Telepon Madin" />

                <Input
                    id="telepon_madin"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.telepon_madin"
                    required
                    autocomplete="telepon_madin"
                />

                <InputError class="mt-2" :message="form.errors.telepon_madin" />
            </div>
            <div>
                <Label for="email_madin" value="Email Madin" />

                <Input
                    id="email_madin"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.email_madin"
                    required
                    autocomplete="email_madin"
                />

                <InputError class="mt-2" :message="form.errors.email_madin" />
            </div>
            <div>
                <Label
                    for="nomor_statistik_madin"
                    value="Nomor Statistik Madin"
                />

                <Input
                    id="nomor_statistik_madin"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.nomor_statistik_madin"
                    required
                    autocomplete="nomor_statistik_madin"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.nomor_statistik_madin"
                />
            </div>
            <div>
                <Label for="kepala_madin" value="Kepala Madin" />

                <Input
                    id="kepala_madin"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.kepala_madin"
                    required
                    autocomplete="kepala_madin"
                />

                <InputError class="mt-2" :message="form.errors.kepala_madin" />
            </div>
            <div>
                <Label for="bendahara_madin" value="Bendahara Madin" />

                <Input
                    id="bendahara_madin"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.bendahara_madin"
                    required
                    autocomplete="bendahara_madin"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.bendahara_madin"
                />
            </div>
            <div>
                <Label for="sekretaris_madin" value="Sekretaris Madin" />

                <Input
                    id="sekretaris_madin"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.sekretaris_madin"
                    required
                    autocomplete="sekretaris_madin"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.sekretaris_madin"
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
