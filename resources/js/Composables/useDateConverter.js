export const useDateConverter = () => {
    // Konversi ke zona waktu Indonesia (WIB)
    const convertIdZone = (string) => {
        const dateString = string;
        const date = new Date(dateString);
        const options = {
            weekday: "long",
            day: "2-digit",
            month: "long",
            year: "numeric",
            hour: "2-digit",
            minute: "2-digit",
            timeZone: "Asia/Jakarta",
        };
        const formattedDate = new Intl.DateTimeFormat("id-ID", options).format(
            date
        );

        return formattedDate;
    };

    return { convertIdZone };
};
