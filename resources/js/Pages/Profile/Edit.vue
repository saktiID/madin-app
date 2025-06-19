<script setup>
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdateProfilePhotoForm from "./Partials/UpdateProfilePhotoForm.vue";

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});
</script>

<template>
    <Head title="Profil" />
    <!-- breadcrumb -->
    <div class="py-4">
        <Breadcrumb :paths="[{ name: 'Profil', url: '#' }]" />
    </div>

    <!-- heading -->
    <div class="py-4">
        <h2
            class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
        >
            Profile
        </h2>
    </div>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <UpdateProfilePhotoForm class="max-w-xl" />
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <UpdateProfileInformationForm
                :must-verify-email="mustVerifyEmail"
                :status="status"
                class="max-w-xl"
            />
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <UpdatePasswordForm class="max-w-xl" />
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <DeleteUserForm class="max-w-xl" />
        </div>
    </div>
</template>
