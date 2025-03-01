<script setup lang="ts">

import AppLayout from "@/layouts/AppLayout.vue";
import {useForm, usePage} from "@inertiajs/vue3";
import {SharedData, User} from "@/types";
import {Table, TableBody, TableCell, TableHead, TableHeader, TableRow} from "@/components/ui/table";
import {DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger} from "@/components/ui/dropdown-menu";
import { EllipsisVertical, Plus } from 'lucide-vue-next';
import {Button} from "@/components/ui/button";
import DialogAddEditPlayers from "@/pages/Players/atoms/DialogAddEditPlayers.vue";

interface Players {
    data: object
}

interface Props {
    Players: Players
}

const props = defineProps<Props>();

const page = usePage<SharedData>();
const user = page.props.auth.user as User;

</script>

<template>
    <AppLayout>
        <div class="p-4 relative">
            <div class="flex w-full justify-between items-center mb-4">
                <h2 class="text-xl">Игроки в системе</h2>
                <Button><Plus/>Добавить игрока</Button>
            </div>
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-32 text-center whitespace-nowrap">ID</TableHead>
                        <TableHead class="w-56 min-w-56 max-w-56 text-left whitespace-nowrap">Ник игрока</TableHead>
                        <TableHead class="w-32 min-w-32 max-w-32 text-center whitespace-nowrap">Server ID</TableHead>
                        <TableHead class="w-32 min-w-32 max-w-32 text-center whitespace-nowrap">Discord ID</TableHead>
                        <TableHead class="w-40 min-w-40 max-w-40 text-center whitespace-nowrap">Баланс</TableHead>
                        <TableHead class="w-full text-right whitespace-nowrap">Опции</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="player in props.Players.data" :key="player.id">
                        <TableCell class="w-32 text-left">{{ player.id }}</TableCell>
                        <TableCell class="w-96 text-left">{{ player.name }}</TableCell>
                        <TableCell class="w-32 text-center">{{ player.server_id }}</TableCell>
                        <TableCell class="w-32 text-center">{{ player.discord_id }}</TableCell>
                        <TableCell class="w-40 text-center">{{ player.balance }}</TableCell>
                        <TableCell class="w-full text-right">

                            <DialogAddEditPlayers :player="player"/>

<!--                            <Dialog>-->
<!--                                <DialogTrigger>-->
<!--                                    <Badge>Редактировать</Badge>-->
<!--                                </DialogTrigger>-->
<!--                                <DialogContent>-->
<!--                                    <DialogHeader>-->
<!--                                        <DialogTitle>Создание игрока</DialogTitle>-->
<!--                                        <DialogDescription>-->
<!--                                            Форма создания записи об игроке в системе. <br/>-->
<!--                                            (Обязательное заполнение ID)-->
<!--                                        </DialogDescription>-->
<!--                                    </DialogHeader>-->
<!--                                    <form @submit.prevent="update" class="py-6">-->
<!--                                        <div class="grid gap-2">-->
<!--                                            <Label for="name" class="text-right">Ник игрока</Label>-->
<!--                                            <Input id="name" :v-model="form.name" required autocomplete="name" placeholder="Nickname" class="mt-1 block w-full"/>-->
<!--                                            <InputError class="mt-2" :message="form.errors.name"/>-->
<!--                                        </div>-->
<!--                                    </form>-->
<!--                                    <DialogFooter>-->
<!--                                        <Button type="submit">-->
<!--                                            Сохранить-->
<!--                                        </Button>-->
<!--                                    </DialogFooter>-->
<!--                                </DialogContent>-->
<!--                            </Dialog>-->

                            <DropdownMenu>
                                <DropdownMenuTrigger>
                                    <EllipsisVertical/>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent>
                                    <DropdownMenuItem>История транзакций</DropdownMenuItem>
                                    <DropdownMenuItem>
                                    </DropdownMenuItem>
                                    <DropdownMenuItem>Удалить</DropdownMenuItem>
                                </DropdownMenuContent>
                            </DropdownMenu>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>

        </div>
    </AppLayout>
</template>

<style scoped>

</style>
