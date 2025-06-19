<script setup>
import ProfilePhotoForm from "./ProfilePhotoForm.vue";
import ProfileInformationForm from "./ProfileInformationForm.vue";
import UstadzInformationForm from "./UstadzInformationForm.vue";
import PasswordForm from "./PasswordForm.vue";
import DeleteUstadzForm from "./DeleteUstadzForm.vue";
import BackButton from "@/Components/BackButton.vue";
</script>

<template>
    <Head title="Edit Data Asatidz" />

    <!-- breadcrumb -->
    <div class="py-4">
        <Breadcrumb
            :paths="[
                { name: 'Master Data', url: '#' },
                {
                    name: 'Data Asatidz',
                    url: route('admin.master-data.data-asatidz.index'),
                },
                { name: 'Edit', url: '#' },
            ]"
        />
    </div>

    <div class="py-4">
        <div
            class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between"
        >
            <BackButton
                href="admin.master-data.data-asatidz.index"
                header-teks="Edit Data Asatidz"
            />
        </div>
    </div>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <ProfilePhotoForm class="max-w-xl" />
        </div>
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <ProfileInformationForm class="max-w-xl" />
        </div>
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <PasswordForm class="max-w-xl" />
        </div>
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <UstadzInformationForm class="max-w-xl" />
        </div>
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <DeleteUstadzForm class="max-w-xl" />
        </div>
    </div>
</template>
