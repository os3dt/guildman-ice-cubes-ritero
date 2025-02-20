<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
import DeleteModal from "@/Components/Modals/DeleteModal.vue";
import {PencilIcon, TrashIcon} from "@heroicons/vue/24/outline/index.js";
import AddEditPriceIceSideForm from "@/Pages/PriceIce/AddEditPriceIceSideForm.vue";

const props = defineProps([
    'dbItems',
    'icePrices'
])
const isAddEditSideFormOpen = ref(false)
const isModalDeleteOpen = ref(false)

const handleDelete = (item) => {
    Inertia.delete(route('price-ice.destroy', item), {
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
                Расценка ресурсов в 🧊 на базе АР
            </h2>

            <SecondaryButton @click="isAddEditSideFormOpen = true">Добавить</SecondaryButton>
        </template>


        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden sm:rounded-lg"
                >
                    <div class="flex gap-20">
                        <span class="text-red-600">
                            Цены на услуги<br>
                            Роль дс - 10 000 <br>
                            Лор - 20 000 <br>
                            Скин - 25 000 <br>
                            Чибик - 50 000 <br>
                            Домик - 100 000 <br>
                            Арт - 200 000 <br>
                        </span>
                        <span class="text-blue-500">
                            Постройка схемат: <br>
                            Маленький (1-2ч) - 1500 <br>
                            средний (3-5ч)- 3000 <br>
                            большой (7-10ч)- 5000 <br>
                            гига пенис (10+ч)- 7500
                        </span>
                        <span class="text-green-600">
                            Постройка:<br>
                            механизм (500-3000)<br>
                            ферма (500-3000)<br>
                        </span>
                    </div>

                    <div class="p-4 w-full">
                        <table class="w-full whitespace-nowrap text-left">
                            <thead class="border-b border-white/10 text-sm leading-6 text-gray-700 w-full">
                            <tr>
                                <th class="py-2 text-base text-left font-semibold">Предмет</th>
                                <th class="py-2 text-base text-center font-semibold">🧊 за шт</th>
                                <th class="py-2 text-base text-center font-semibold">🧊 за стак</th>
                                <th class="py-2 text-base text-center font-semibold">🧊 за шалкер</th>
                                <th class="py-2 text-base text-center font-semibold">💎 АР за шт</th>
                                <th class="py-2 text-base text-center font-semibold">💎 АР за стак</th>
                                <th class="py-2 text-base text-center font-semibold">💎 АР за шалкер</th>
                                <th class="py-2 text-base text-center font-semibold">Опции</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                            <template v-for="item in icePrices.data" :key="item.id" class="">
                                <tr class="divide-y">
                                    <td class="py-4 text-sm text-center leading-6 text-gray-700 border-t">
                                        <div class="flex items-center gap-4">
                                            <img :src="item.dbItem.icon" class="sm:size-12" alt="{{ item.dbItem.name }}">
                                            <span class="text-center font-semibold text-sm"> {{ item.dbItem.name }} </span>
                                        </div>
                                    </td>
                                    <td class="py-4 text-sm text-center leading-6 text-gray-700">{{ item.one != 0 ? item.one : '-'}}</td>
                                    <td class="py-4 text-sm text-center leading-6 text-gray-700">{{ item.stack != 0 ? item.stack : '-'}}</td>
                                    <td class="py-4 text-sm text-center leading-6 text-gray-700">{{ item.shulker != 0 ? item.shulker : '-'}}</td>
                                    <td class="py-4 text-sm text-center leading-6 text-gray-700">{{ item?.dbPrice?.avg_one ? item?.dbPrice?.avg_one : '-'}}</td>
                                    <td class="py-4 text-sm text-center leading-6 text-gray-700">{{ item?.dbPrice?.avg_stack ? item?.dbPrice?.avg_stack : '-' }}</td>
                                    <td class="py-4 text-sm text-center leading-6 text-gray-700">{{ item?.dbPrice?.avg_shulker ? item?.dbPrice?.avg_shulker : '-'}}</td>
                                    <td class="py-4 text-sm text-center leading-6 text-gray-700">
                                        <div class="w-full gap-4 flex items-center justify-center">
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

        <AddEditPriceIceSideForm v-model="isAddEditSideFormOpen" :items="dbItems"/>

        <DeleteModal
            :title="`Удаление расценки на реурс: «${isModalDeleteOpen?.dbItem?.name}»`"
            v-model="isModalDeleteOpen"
            @submit="handleDelete(isModalDeleteOpen)"
        >
            <template #modalText>
                Вы уверены, расценку на ресурс <span class="text-blue-600">«{{ isModalDeleteOpen?.dbItem?.name }}»</span>?
                <br/> Это действие необратимо, и восстановить данные будет невозможно.
            </template>
        </DeleteModal>
    </AuthenticatedLayout>
</template>
