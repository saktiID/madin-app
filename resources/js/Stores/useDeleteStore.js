import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";

export const useDeleteStore = defineStore("deleteStore", {
    state: () => ({
        isLoading: false,
        showModalDelete: false,
        showDeleteButton: false,
        form: useForm({ id: null }),
        deleteName: [],
        checked: [],
    }),

    actions: {
        setIsLoading() {
            this.isLoading = !this.isLoading;
        },
        setShowModalDelete() {
            this.showModalDelete = !this.showModalDelete;
        },
        setShowDeleteButton() {
            this.showDeleteButton = !this.showDeleteButton;
        },

        setForm(data) {
            this.form.id = data;
        },
        setDeleteName(data) {
            this.deleteName = data ? [...this.deleteName, data] : [];
        },
        setChecked(data) {
            this.checked = data ? [...this.checked, data] : [];
        },
    },
});
