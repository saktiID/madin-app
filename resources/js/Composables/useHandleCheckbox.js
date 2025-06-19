import { useDeleteStore } from "@/Stores/useDeleteStore";

export const useHandleCheckbox = () => {
    const deleteStore = useDeleteStore();

    const handleCheckboxAll = (event) => {
        const checkbox = event.target;
        const checkboxes = document.querySelectorAll(
            'input[type="checkbox"]:not(#checkbox-all-search)'
        );
        checkboxes.forEach((cb) => {
            cb.checked = checkbox.checked;
        });
        deleteStore.checked = Array.from(checkboxes)
            .filter((cb) => cb.checked)
            .map((cb) => cb.id);

        deleteStore.showDeleteButton = deleteStore.checked.length > 0;
    };

    const handleCheckboxChecked = () => {
        const checkboxes = document.querySelectorAll(
            'input[type="checkbox"]:not(#checkbox-all-search)'
        );
        const allChecked = Array.from(checkboxes).every((cb) => cb.checked);
        document.getElementById("checkbox-all-search").checked = allChecked;

        deleteStore.checked = Array.from(checkboxes)
            .filter((cb) => cb.checked)
            .map((cb) => cb.id);

        deleteStore.showDeleteButton = deleteStore.checked.length > 0;
    };

    return { handleCheckboxAll, handleCheckboxChecked };
};
