<script setup>
import VueDatePicker from "@vuepic/vue-datepicker";
import '@vuepic/vue-datepicker/dist/main.css';
import {ru} from "date-fns/locale";

defineProps({
    format: {
        type: String,
        default: 'EEEE, dd MMMM yyyy',
    },
    enableTimePicker: {
        type: Boolean,
        default: false,
    }
})
</script>

<template>
    <VueDatePicker
        locale="ru"
        :format-locale="ru"
        :format="format"
        select-text="Выбрать"
        cancel-text="Отмена"
        now-button-label="Сегодня"
        :enable-time-picker="enableTimePicker"
        :auto-apply="true"
        :show-now-button="true"
    >
    </VueDatePicker>
</template>
