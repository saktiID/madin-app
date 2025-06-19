<script setup>
defineProps({
    colspan: {
        type: Number,
        default: 1,
    },
});
</script>

<template>
    <tr class="bg-gray-200 dark:bg-gray-800">
        <td :colspan="colspan" class="w-4 p-4 text-center">
            <img
                src="/storage/img/no-result.png"
                class="m-auto"
                width="150"
                alt="no result"
            />

            Tidak menemukan hasil
        </td>
    </tr>
</template>
