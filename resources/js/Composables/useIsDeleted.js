import { useToast } from "vue-toastification";
const toast = useToast();

export const useIsDeleted = () => {
    const isDeleted = () => {
        const param = new URLSearchParams(window.location.search);
        const isDeleted = param.get("deleted") === "1";

        if (isDeleted) {
            toast.success("Data asatidz berhasil dihapus.");
            param.delete("deleted");
            window.history.replaceState(
                {},
                "",
                `${window.location.pathname}?${param}`
            );
            window.successSFX.play();
        }
    };

    return { isDeleted };
};
