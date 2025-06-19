import { usePage } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { useDeleteStore } from "@/Stores/useDeleteStore";

export const useHandleDelete = (option) => {
    const { nameProperty, deletePath, only } = option;
    const deleteStore = useDeleteStore();
    const toast = useToast();

    const handleSingleDeleteButton = (id, name) => {
        deleteStore.setShowModalDelete();
        deleteStore.setDeleteName();
        deleteStore.setChecked();
        deleteStore.setDeleteName(name);
        deleteStore.setChecked(id);
    };

    const handleMultipleDeleteButton = (items) => {
        deleteStore.setShowModalDelete();
        deleteStore.setDeleteName();
        deleteStore.checked.forEach((id) => {
            const item = items.data.find((item) => item.id === id);
            if (item) {
                deleteStore.deleteName.push(item[nameProperty]);
            }
        });
    };

    const handleDelete = () => {
        deleteStore.setIsLoading();
        deleteStore.showDeleteButton = false;
        deleteStore.form.id = deleteStore.checked.flat();
        deleteStore.form.delete(route(deletePath), {
            preserveScroll: true,
            only: only,
            onSuccess: () => {
                deleteStore.checked = [];
                deleteStore.deleteName = [];
                document
                    .querySelectorAll('input[type="checkbox"]')
                    .forEach((cb) => (cb.checked = false));
            },
            onError: (error) => {
                console.error("Kesalahan:", error);
            },
            onFinish: () => {
                closeModal();
                deleteStore.isLoading = false;
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
        });
    };

    const closeModal = () => {
        deleteStore.showModalDelete = false;
    };

    return {
        handleSingleDeleteButton,
        handleMultipleDeleteButton,
        handleDelete,
        closeModal,
    };
};
