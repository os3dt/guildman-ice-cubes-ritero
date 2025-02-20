<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
import {
    PencilIcon,
    TrashIcon
} from '@heroicons/vue/24/outline'
import AddEditMinecraftDBSideForm from "@/Pages/MinecraftDB/AddEditMinecraftDBSideForm.vue";
import DeleteModal from "@/Components/Modals/DeleteModal.vue";

const props = defineProps(['db_items'])
const isAddEditSideFormOpen = ref(false)
const isModalDeleteOpen = ref(false)

const handleDelete = (item) => {
    Inertia.delete(route('minecraft-db.destroy', item), {
        onSuccess: isModalDeleteOpen.value = false
    })
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                База блоков и предметов
            </h2>

            <SecondaryButton @click="isAddEditSideFormOpen = true">Добавить в базу</SecondaryButton>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden sm:rounded-lg"
                >
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-1">
                        <div
                            v-for="item in db_items"
                            :key="item.id"
                            class="relative aspect-square bg-white rounded-xl flex flex-col items-center justify-center p-4 border border-gray-300">
                            <img :src="item.icon" class="sm:size-12 md:size-16 lg:size-24 xl:size-32" alt="{{ item.name }}">
                            <div class="text-center break-words">{{item.name}} </div>
                            <span class="absolute top-2 left-2 text-gray-400">x{{item.stack}}</span>
                            <div class="absolute top-1 right-1">
                                <div class="flex">
                                    <button
                                        class="!bg-transparent !border-none !shadow-none !w-fit !h-fit !mx-auto"
                                        @click="isAddEditSideFormOpen = item"
                                    ><PencilIcon class="w-6 text-blue-600/40"/></button>
                                    <button
                                        class="!bg-transparent !border-none !shadow-none !w-fit !h-fit !mx-auto"
                                        @click="isModalDeleteOpen = item"
                                    ><TrashIcon class="w-6 text-red-600/40"/></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <AddEditMinecraftDBSideForm v-model="isAddEditSideFormOpen" />

        <DeleteModal
            :title="`Удаление элемента базы Minecraft: «${isModalDeleteOpen?.name}»`"
            v-model="isModalDeleteOpen"
            @submit="handleDelete(isModalDeleteOpen)"
        >
            <template #modalText>
                Вы уверены, что хотите удалить <span class="text-blue-600">«{{ isModalDeleteOpen?.name }}»</span>?
                <br/> Это действие необратимо, и восстановить данные будет невозможно.
            </template>
        </DeleteModal>

    </AuthenticatedLayout>
</template>

<style scoped>

</style>
