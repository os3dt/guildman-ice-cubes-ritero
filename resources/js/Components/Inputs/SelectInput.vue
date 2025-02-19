<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps(['items', 'modelValue']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <select
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-sm shadow-sm"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input">

        <template v-if="items.length > 0 && items[0].constructor === Object">
            <option v-for="item in items" :key="item.value" :selected="String(item.value) === String(modelValue)" :value="item.value" :disabled="item.disabled">{{ item.label }}</option>
        </template>

        <template v-else>
            <option v-for="(label, value) in items" :key="value" :selected="String(item.value) === String(modelValue)" :value="value">{{ label }}</option>
        </template>
    </select>
</template>
