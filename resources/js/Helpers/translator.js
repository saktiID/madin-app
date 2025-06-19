export function createTranslator(translations) {
    return function t(path, params = {}) {
        const keys = path.split(".");
        let text = translations;

        for (const key of keys) {
            text = text?.[key];
            if (!text) return path;
        }

        for (const [key, value] of Object.entries(params)) {
            text = text.replace(`:${key}`, value);
        }

        return text;
    };
}
