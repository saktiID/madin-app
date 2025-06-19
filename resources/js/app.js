import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp, Link } from "@inertiajs/vue3";
// import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { createTranslator } from "./Helpers/translator";
import { usePage } from "@inertiajs/vue3";
import { watchEffect } from "vue";
import { createPinia } from "pinia";
import "vue-toastification/dist/index.css";

// layout
import Authenticated from "./Layouts/Authenticated.vue";
import { Head } from "@inertiajs/vue3";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import Toast from "vue-toastification";

window.successSFX = new Audio("/audio/Success.wav");
window.errorSFX = new Audio("/audio/Mistake.wav");

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Madin App";
const pinia = createPinia();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        page.default.layout = name.startsWith("Public/")
            ? undefined
            : Authenticated;
        return page;
    },
    // resolve: (name) =>
    //     resolvePageComponent(
    //         `./Pages/${name}.vue`,
    //         import.meta.glob("./Pages/**/*.vue")
    //     ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        const translations = props.initialPage.props.translations;
        const t = createTranslator(translations);
        const page = usePage();

        app.config.globalProperties.$t = t;

        watchEffect(() => {
            const favicon = page.props?.madin?.logo_madin;

            if (favicon) {
                const link =
                    document.querySelector("link[rel~='icon']") ||
                    document.createElement("link");
                link.rel = "icon";
                link.href = `/storage/logo/${favicon}`;
                document.head.appendChild(link);
            }
        });
        app.use(plugin)
            .use(pinia)
            .use(ZiggyVue, Ziggy)
            .use(Toast, {
                position: "top-center",
                timeout: 4000, // durasi 4 detik
                closeOnClick: true,
                pauseOnFocusLoss: true,
                pauseOnHover: true,
                draggable: true,
                draggablePercent: 0.6,
                showCloseButtonOnHover: false,
                hideProgressBar: false,
                closeButton: "button",
                icon: true,
                rtl: false,
            })
            .component("Breadcrumb", Breadcrumb)
            .component("Link", Link)
            .component("Head", Head)
            .mount(el);
    },
    progress: {
        color: "#a855f7",
        showSpinner: true,
    },
});
