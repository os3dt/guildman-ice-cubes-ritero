<script setup lang="ts">
import {ref, defineEmits, watch} from 'vue';
import { Button } from '@/components/ui/button';
import { Dialog, DialogTrigger, DialogContent, DialogHeader, DialogTitle, DialogFooter } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import {useForm} from "@inertiajs/vue3";
import {route} from "ziggy-js";

interface Player {
    id?: number
    name: string,
    server_id: number,
    discord_id: number,
    balance: number
}

interface Props {
    player: Player
}

const props = defineProps<Props>()

const isOpen = ref(false);
const player = ref({
    name: '',
    server_id: 0,
    discord_id: 0,
    balance: 0
});

const form = useForm({
    name: player.value.name,
    server_id: player.value.server_id,
    discord_id: player.value.discord_id,
    balance: player.value.balance
})

watch(
    () => props.player, (newPlayer) => {
        if (newPlayer) {
            player.value = { ...newPlayer };
            isOpen.value = true;
        }
    }, { deep: true, immediate: true }
)

const submit = () => {

    console.log(route('players.update', props.player.id))
    console.log(form)

    // form.patch(route('players.update', props.player.id), {
    //     onSuccess: close
    // })
};

const close = () => isOpen.value = false
</script>

<template>
    <Dialog v-model="isOpen">
        <DialogTrigger>
            <Button @click="isOpen = true">Добавить игрока</Button>
        </DialogTrigger>
        <DialogContent>
            {{ props }}
            <DialogHeader>
                <DialogTitle>Добавить игрока</DialogTitle>
            </DialogHeader>
            <div>
                <label>Имя</label>
                <Input v-model="player.name" />
            </div>
            <div>
                <label>Server ID</label>
                <Input v-model="player.server_id" />
            </div>
            <div>
                <label>Discord ID</label>
                <Input v-model="player.discord_id" />
            </div>
            <div>
                <label>Баланс</label>
                <Input v-model="player.balance" type="number" />
            </div>
            <DialogFooter>
                <Button @click="submit">Сохранить</Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>



<!--<script setup lang="ts">-->

<!--import {-->
<!--    Dialog,-->
<!--    DialogContent,-->
<!--    DialogDescription, DialogFooter,-->
<!--    DialogHeader,-->
<!--    DialogTitle,-->
<!--    DialogTrigger-->
<!--} from "@/components/ui/dialog";-->
<!--import {Badge} from "@/components/ui/badge";-->
<!--import {Button} from "@/components/ui/button";-->
<!--import {Label} from "@/components/ui/label";-->
<!--import InputError from "@/components/InputError.vue";-->
<!--import {Input} from "@/components/ui/input";-->
<!--import {useForm} from "@inertiajs/vue3";-->
<!--import {ref, watch} from "vue";-->

<!--interface Props {-->
<!--    modalValue: {-->
<!--        type: [boolean, object],-->
<!--        required: true,-->
<!--    },-->
<!--}-->

<!--const props = defineProps<Props>()-->

<!--const editMode = ref(props.modalValue && typeof props.modalValue === 'object')-->

<!--const getModalValueForForm = (prop: any, defaultValue = null) => {-->
<!--    return editMode.value ? prop.modalValue[prop] : defaultValue-->
<!--}-->

<!--const form = useForm({-->
<!--    name: null,-->
<!--    server_id: null,-->
<!--    discord_id: null,-->
<!--    balance: null-->
<!--})-->

<!--const fillForm = () => {-->
<!--    form.name = getModalValueForForm('name', null)-->
<!--    form.server_id = getModalValueForForm('server_id', null)-->
<!--    form.discord_id = getModalValueForForm('discord_id', null)-->
<!--    form.balance = getModalValueForForm('balance', null)-->
<!--}-->

<!--watch(-->
<!--    () => props.modalValue,-->
<!--    () => {-->
<!--        editMode.value = props.modalValue && typeof props.modalValue === 'object';-->
<!--        fillForm();-->
<!--    }-->
<!--)-->

<!--const submit = () => {-->
<!--    form.post(editMode.value ? route('players.update', props.modalValue.id) : route('players.store'), {-->
<!--        // onSuccess:-->
<!--    })-->
<!--}-->
<!--</script>-->

<!--<template>-->
<!--    <Dialog>-->
<!--        <DialogTrigger>-->
<!--            <Badge>Редактировать</Badge>-->
<!--        </DialogTrigger>-->
<!--        <DialogContent>-->
<!--            {{ modalValue }}-->
<!--            <DialogHeader>-->
<!--                <DialogTitle>Создание игрока</DialogTitle>-->
<!--                <DialogDescription>-->
<!--                    Форма создания записи об игроке в системе. <br/>-->
<!--                    (Обязательное заполнение ID)-->
<!--                </DialogDescription>-->
<!--            </DialogHeader>-->
<!--            <form @submit.prevent="submit" class="py-6">-->
<!--                <div class="grid gap-2">-->
<!--                    <Label for="name" class="text-right">Ник игрока</Label>-->
<!--                    <Input id="name" :v-model="form.name" required autocomplete="name" placeholder="Nickname" class="mt-1 block w-full"/>-->
<!--                    <InputError class="mt-2" :message="form.errors.name"/>-->
<!--                </div>-->
<!--            </form>-->
<!--            <DialogFooter>-->
<!--                <Button type="submit">-->
<!--                    Сохранить-->
<!--                </Button>-->
<!--            </DialogFooter>-->
<!--        </DialogContent>-->
<!--    </Dialog>-->
<!--</template>-->



