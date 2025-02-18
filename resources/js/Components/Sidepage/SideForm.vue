<script setup>
import {TransitionChild, TransitionRoot, Dialog} from "@headlessui/vue";
import { XMarkIcon } from '@heroicons/vue/24/outline'
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
    modelValue: {
        type: [Boolean, Object],
        required: true,
        default: false,
    },
    title: {
        type: String,
        required: false,
    },
    isLong: {
        type: Boolean,
        required: false,
        default: false
    }
})

const emit = defineEmits(['close'])

const close = () => {
    emit('close')
}

</script>

<template>
    <TransitionRoot :show="!!modelValue" @close="close" as="template">
        <Dialog as="div" class="fixed inset-0 z-50 flex justify-end" @close="close">
            <div class="fixed inset-0 bg-black bg-opacity-50" @click="close"></div>

            <TransitionChild
                enter="ease-out duration-300"
                enter-from="translate-x-full"
                enter-to="translate-x-0"
                leave="ease-in duration-200"
                leave-from="translate-x-0"
                leave-to="translate-x-full"
            >
                <div
                    class="relative bg-white h-full shadow-lg flex flex-col"
                    :class="isLong ? 'w-[800px]' : 'w-[500px]'"
                >
                    <div class="p-6 bg-gray-100 flex items-center justify-between">
                        <slot v-if="title === null" name="header-title" />
                        <span class="text-lg font-semibold" v-else>{{ title }}</span>
                        <button @click="close" class="ml-2 text-gray-500 hover:text-gray-700"><XMarkIcon class="w-6"/> </button>
                    </div>

                    <div class="p-6 flex-1">
                        <slot />
                    </div>

                    <div class="p-6 bg-gray-100 flex gap-2">
                        <slot name="footer-btn" />
                        <SecondaryButton @click="close"> Закрыть </SecondaryButton>
                    </div>
                </div>
            </TransitionChild>
        </Dialog>
    </TransitionRoot>
</template>
