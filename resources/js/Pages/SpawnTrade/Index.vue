<script setup>


import {ref} from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {PencilIcon, TrashIcon} from "@heroicons/vue/24/outline/index.js";
import AddEditSpawnTradeSideForm from "@/Pages/SpawnTrade/AddEditSpawnTradeSideForm.vue";
import DeleteModal from "@/Components/Modals/DeleteModal.vue";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps([
    'db_items',
    'productCosts'
])
const isAddEditSideFormOpen = ref(false)
const isModalDeleteOpen = ref(false)

const handleDelete = (item) => {
    Inertia.delete(route('products-cost.destroy', item), {
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
                Список цен со спавна
            </h2>

            <SecondaryButton @click="isAddEditSideFormOpen = true">Добавить</SecondaryButton>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden sm:rounded-lg bg-white"
                >
                    <div v-for="dItem in db_items.data" class="">
                        <div class="flex p-8 items-start border rounded-xl gap-4">
                            <div class="flex flex-col gap-4 items-center justify-between min-w-[200px]">
                                <div class="flex flex-col items-center border rounded-xl p-8 gap-x-4 min-w-[200px] min-h-[200px] max-w-[200px] max-h-[200px]">
                                    <img :src="dItem.icon" alt="" class="size-24" />
                                    <div class="break-words text-sm text-center font-medium text-gray-700">{{ dItem.name }}</div>
                                </div>
                                <button class="w-full items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50" @click="isAddEditSideFormOpen = true">Добавить</button>
                            </div>
                            <div class="p-4 w-full">
                                <table class="w-full whitespace-nowrap text-left">
                                    <thead class="border-b border-white/10 text-sm leading-6 text-gray-700 w-full">
                                    <tr>
                                        <th class="py-2 text-center w-1/5 font-semibold">Цена за шт</th>
                                        <th class="py-2 text-center w-1/5 font-semibold">Цена за шалкер</th>
                                        <th class="py-2 text-center w-1/5 font-semibold">Продавец</th>
                                        <th class="py-2 text-center w-2/5 font-semibold sr-only"></th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-white/5">
                                    <template v-for="item in productCosts.data" :key="item.id" class="">
                                        <tr v-if="dItem.id === item.db_item_id" class="">
                                            <td class="py-4 text-sm text-center leading-6 text-gray-700 border-b">{{ item.one_stack }}</td>
                                            <td class="py-4 text-sm text-center leading-6 text-gray-700 border-b">{{ item.one_shulker !== null ? item.one_shulker : '-' }}</td>
                                            <td class="py-4 text-sm text-center leading-6 text-gray-700 border-b">{{ item.trader }}</td>
                                            <td class="py-4 text-sm text-center leading-6 text-gray-700 border-b">
                                                <div class="w-full gap-4 flex justify-end">
                                                    <button
                                                        @click="isAddEditSideFormOpen = item">
                                                        <PencilIcon class="size-6 text-blue-800"/>
                                                    </button>
                                                    <button
                                                        @click="isModalDeleteOpen = item">
                                                        <TrashIcon class="size-6 text-red-600"/>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <AddEditSpawnTradeSideForm v-model="isAddEditSideFormOpen" :items="db_items"/>

        <DeleteModal
            :title="`Удаление лота продавца: «${isModalDeleteOpen?.trader}»`"
            v-model="isModalDeleteOpen"
            @submit="handleDelete(isModalDeleteOpen)"
        >
            <template #modalText>
                Вы уверены, что хотите удалить лот от <span class="text-blue-600">«{{ isModalDeleteOpen?.trader }}» из базы</span>?
                <br/> Это действие необратимо, и восстановить данные будет невозможно.
            </template>
        </DeleteModal>

    </AuthenticatedLayout>
</template>

