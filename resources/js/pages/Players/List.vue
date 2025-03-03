<template>
    <AppLayout>
        <div class="p-4 relative">
            <div class="flex w-full justify-between items-center mb-4">
                <h2 class="text-xl">Игроки в системе</h2>
                <PlayerFormDialog :is-add=true></PlayerFormDialog>
            </div>
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-32 text-center whitespace-nowrap">ID</TableHead>
                        <TableHead class="w-56 min-w-56 max-w-56 text-left whitespace-nowrap">Ник игрока</TableHead>
                        <TableHead class="w-40 min-w-40 max-w-40 text-left whitespace-nowrap">Server ID</TableHead>
                        <TableHead class="w-40 min-w-40 max-w-40 text-left whitespace-nowrap">Discord ID</TableHead>
                        <TableHead class="w-48 min-w-48 max-w-48 text-center whitespace-nowrap">Баланс</TableHead>
                        <TableHead class="w-48 min-w-48 max-w-48 text-center whitespace-nowrap">Учетная запись</TableHead>
                        <TableHead class="w-full text-right whitespace-nowrap">Опции</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="player in props.Players.data" :key="player.id">
                        <TableCell class="w-32 text-left">{{ player.id }}</TableCell>
                        <TableCell class="w-96 text-left">{{ player.name }}</TableCell>
                        <TableCell class="w-40 text-center">{{ player.server_id }}</TableCell>
                        <TableCell class="w-40 text-center">{{ player.discord_id }}</TableCell>
                        <TableCell class="w-48 text-center">{{ player.balance }}</TableCell>
                        <TableCell class="w-48 text-center">
                            <Badge v-if="player.is_locked" variant="default" class="bg-green-700">Доступ разрешен</Badge>
                            <Badge v-else variant="destructive">
                                Ограниченный доступ
                            </Badge>
                        </TableCell>
                        <TableCell class="w-full text-right">
                            <PlayerFormDialog :player="player"/>
<!--                            <PlayerDeleteAlertDialog :player="player"/>-->
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">

import AppLayout from "@/layouts/AppLayout.vue";
import {usePage} from "@inertiajs/vue3";
import {SharedData, User} from "@/types";
import {Table, TableBody, TableCell, TableHead, TableHeader, TableRow} from "@/components/ui/table";
import PlayerFormDialog from "@/pages/Players/PlayerFormDialog.vue";
import {AlertDialog} from "@/components/ui/alert-dialog";
import PlayerDeleteAlertDialog from "@/pages/Players/PlayerLockUnlockAlertDialog.vue";
import {Badge} from "@/components/ui/badge";

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
