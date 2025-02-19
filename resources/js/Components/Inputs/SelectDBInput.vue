<template>
    <div class="relative">
        <div
            class="border p-2 cursor-pointer flex items-center gap-2 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
            @click="isOpen = !isOpen">
            <img v-if="selectedItem" :src="selectedItem.icon" class="w-6 h-6" />
            <span>{{ selectedItem ? selectedItem.label : "Выберите" }}</span>
        </div>
        <ul
            v-if="isOpen"
            class="absolute border bg-white w-full">
            <li
                v-for="item in items"
                :key="item.value"
                class="p-2 flex items-center gap-2 cursor-pointer hover:bg-gray-100"
                @click="selectItem(item)">
                <img :src="item.icon" class="w-6 h-6" />
                {{ item.label }}
            </li>
        </ul>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";

const props = defineProps(["items", "modelValue"]);
const emit = defineEmits(["update:modelValue"]);

const isOpen = ref(false);

const selectedItem = computed(() => props.items.find(i => String(i.value) === String(props.modelValue)));

const selectItem = (item) => {
    emit("update:modelValue", item.value);
    isOpen.value = false;
};
</script>
