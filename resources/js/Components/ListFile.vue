<script setup>
import { toRefs } from "vue";
import { TrashIcon, CollectionIcon } from "@heroicons/vue/outline";
import { useDateConverter } from "@/Composables/useDateConverter";

const props = defineProps({
    filename: {
        type: String,
        required: true,
    },
    filedate: {
        type: String,
        required: true,
    },
    filesize: {
        type: String,
        required: true,
    },
    isImported: {
        type: [Boolean, Number],
        required: true,
    },
    log: {
        type: [String, null],
    },
    disabled: {
        type: Boolean,
        default: false,
    },
});

const { disabled } = toRefs(props);
const emit = defineEmits(["clickParsing", "clickDelete"]);
const clickParsing = () => emit("clickParsing");
const clickDelete = () => emit("clickDelete");
const { convertIdZone } = useDateConverter();
</script>

<template>
    <li class="p-3 hover:bg-gray-100 dark:hover:bg-gray-700">
        <div class="flex items-center space-x-4 rtl:space-x-reverse">
            <div class="shrink-0">
                <!--  -->
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-8 h-8 fill-current"
                    viewBox="0 0 16 16"
                >
                    <path
                        fill-rule="evenodd"
                        d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM7.86 14.841a1.13 1.13 0 0 0 .401.823q.195.162.479.252.284.091.665.091.507 0 .858-.158.355-.158.54-.44a1.17 1.17 0 0 0 .187-.656q0-.336-.135-.56a1 1 0 0 0-.375-.357 2 2 0 0 0-.565-.21l-.621-.144a1 1 0 0 1-.405-.176.37.37 0 0 1-.143-.299q0-.234.184-.384.188-.152.513-.152.214 0 .37.068a.6.6 0 0 1 .245.181.56.56 0 0 1 .12.258h.75a1.1 1.1 0 0 0-.199-.566 1.2 1.2 0 0 0-.5-.41 1.8 1.8 0 0 0-.78-.152q-.44 0-.777.15-.336.149-.527.421-.19.273-.19.639 0 .302.123.524t.351.367q.229.143.54.213l.618.144q.31.073.462.193a.39.39 0 0 1 .153.326.5.5 0 0 1-.085.29.56.56 0 0 1-.255.193q-.168.07-.413.07-.176 0-.32-.04a.8.8 0 0 1-.249-.115.58.58 0 0 1-.255-.384zm-3.726-2.909h.893l-1.274 2.007 1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415H1.5l1.24-2.016-1.228-1.983h.931l.832 1.438h.036zm1.923 3.325h1.697v.674H5.266v-3.999h.791zm7.636-3.325h.893l-1.274 2.007 1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415h-.861l1.24-2.016-1.228-1.983h.931l.832 1.438h.036z"
                    />
                </svg>
                <!--  -->
            </div>
            <div class="flex-1 min-w-0 hover:cursor-pointer">
                <p
                    class="text-sm font-medium text-gray-900 truncate dark:text-white hover:underline"
                >
                    <a
                        :href="
                            route('admin.master-data.data-asatidz.download', {
                                filename: props.filename,
                            })
                        "
                    >
                        {{ props.filename }}
                    </a>
                </p>
                <p class="text-xs text-gray-500 truncate dark:text-gray-400">
                    Tanggal: {{ convertIdZone(props.filedate) }} <br />
                    Ukuran: {{ filesize }}kB
                </p>
            </div>
            <div class="inline-flex items-center gap-2">
                <div v-if="!isImported && log == null" class="relative group">
                    <button
                        @click="clickParsing"
                        :disabled="disabled"
                        class="px-3 py-3 text-xs text-white rounded-full bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <CollectionIcon class="w-4 h-4 text-white" />
                    </button>
                    <div
                        class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block px-2 py-1 text-xs font-medium text-white bg-gray-900 rounded-md dark:bg-gray-700 text-center"
                    >
                        Parsing file
                    </div>
                    <div
                        class="absolute left-1/2 -translate-x-1/2 -top-2 w-0 h-0 border-[6px] border-transparent border-t-gray-900 dark:border-t-gray-700 hidden group-hover:block"
                    ></div>
                </div>
                <div class="relative group">
                    <button
                        @click="clickDelete"
                        :disabled="disabled"
                        class="px-3 py-3 text-xs text-white rounded-full bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-400 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <TrashIcon class="w-4 h-4 text-white" />
                    </button>
                    <div
                        class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block px-2 py-1 text-xs font-medium text-white bg-gray-900 rounded-md dark:bg-gray-700 text-center"
                    >
                        Hapus file
                    </div>
                    <div
                        class="absolute left-1/2 -translate-x-1/2 -top-2 w-0 h-0 border-[6px] border-transparent border-t-gray-900 dark:border-t-gray-700 hidden group-hover:block"
                    ></div>
                </div>
            </div>
        </div>

        <slot />
    </li>
</template>
