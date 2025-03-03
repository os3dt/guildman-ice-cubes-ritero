<template>
    <AppLayout>
        <div class="p-4 relative">
<!--            {{ props.products.data }}-->
            <div class="flex w-full justify-between items-center mb-4">
                <h2 class="text-xl">Цены на услуги</h2>
<!--                <PlayerFormDialog :is-add=true></PlayerFormDialog>-->
            </div>
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead class="text-center whitespace-nowrap">ID</TableHead>
                        <TableHead class="text-left whitespace-nowrap">Название услуги</TableHead>
                        <TableHead class="text-left whitespace-nowrap">Цена</TableHead>
                        <TableHead class="w-full text-right whitespace-nowrap">Опции</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="product in props.products.data" :key="product.id">
                        <TableCell class="text-center">{{ product.id }}</TableCell>
                        <TableCell class="text-left lg:whitespace-nowrap">{{ product.name }}</TableCell>
                        <TableCell class="text-left">{{ product.price }}</TableCell>
                        <TableCell class="w-full text-right">

                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">

import AppLayout from "@/layouts/AppLayout.vue";
import {Table, TableBody, TableCell, TableHead, TableHeader, TableRow} from "@/components/ui/table";

interface Products {
    data: object
}

interface Props { products: Products}

const props = defineProps<Props>()
</script>
