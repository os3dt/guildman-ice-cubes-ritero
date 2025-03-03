<template>
    <Dialog v-model:open="isOpen">

        <DialogTrigger>
            <span v-if="!isAdd"><Pen class="text-blue-700/70 size-5"/></span>
            <div v-if="isAdd" class="flex flex-row items-center gap-0.5">
                <Plus class="text-gray-100 size-4 " ></Plus>
                <span>Добавить</span>
            </div>
        </DialogTrigger>

        <DialogContent>
            <DialogHeader>
                <DialogTitle>
                    {{ isAdd ? "Добавление нового игрока" : "Редактирование игрока" }}
                </DialogTitle>
                <DialogDescription>
                    {{ isAdd
                    ? "Вы можете добавить игрока заполнив форму. ПРИМЕНЯТЬ ДОБАВЛЕНИЕ ЧЕРЕЗ АДМИНКУ ТОЛЬКО В КРАЙНЕМ СЛУЧАЕ!!!"
                    : "Вы можете отредактировать информацию по игроку. Изменять только если знаете, что делаете!!!!" }}
                </DialogDescription>
            </DialogHeader>

            <form class="space-y-6" @submit="onSubmit">
                <FormField v-slot="{ componentField }" name="name">
                    <FormItem>
                        <FormLabel>Игровое имя</FormLabel>
                        <FormControl>
                            <Input type="text" placeholder="name" v-bind="componentField" />
                        </FormControl>
                        <FormDescription>
                            Ник игрока в игре
                        </FormDescription>
                        <FormMessage />
                    </FormItem>
                </FormField>

                <FormField v-slot="{ componentField }" name="server_id">
                    <FormItem>
                        <FormLabel>Server ID</FormLabel>
                        <FormControl>
                            <Input type="text" placeholder="server id" v-bind="componentField" />
                        </FormControl>
                        <FormDescription>
                            ID сервера к которому привязан бот и сайт. (ПКМ по серверу и нажать на скопировать ID)
                        </FormDescription>
                        <FormMessage />
                    </FormItem>
                </FormField>

                <FormField v-slot="{ componentField }" name="discord_id">
                    <FormItem>
                        <FormLabel>Discord ID</FormLabel>
                        <FormControl>
                            <Input type="text" placeholder="discord id" v-bind="componentField" />
                        </FormControl>
                        <FormDescription>
                            ID пользователя в Discord (ПКМ по пользователю и нажать на скопировать ID)
                        </FormDescription>
                        <FormMessage />
                    </FormItem>
                </FormField>

                <div class="mt-4 flex gap-2 md:gap-4 items-center">
                    <Button type="submit">
                        Сохранить
                    </Button>

                    <DialogClose>
                        <button variant="secondary">Закрыть</button>
                    </DialogClose>
                </div>

            </form>
        </DialogContent>
    </Dialog>
</template>

<script setup lang="ts">
import { Button } from '@/components/ui/button'
import {
    FormControl,
    FormDescription,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from '@/components/ui/form'
import { Input } from '@/components/ui/input'
import { Pen, Plus } from 'lucide-vue-next';
import { router } from '@inertiajs/vue3'

import { toTypedSchema } from '@vee-validate/zod'
import {useField, useForm} from 'vee-validate'
import {h, ref, watch} from 'vue'
import * as z from 'zod'
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
    DialogTrigger
} from "@/components/ui/dialog";

interface Props {
    player?: {
        id: number,
        name: string,
        server_id: number,
        discord_id: number
    },
    isAdd?: boolean,
}

const props = defineProps<Props>()
const isOpen = ref(false)

const formSchema = toTypedSchema(z.object({
    id: z.number().optional(),
    name: z.string().min(2).max(50),
    server_id: z.coerce.string().min(9),
    discord_id: z.coerce.string().min(9),
}))

const { handleSubmit, setValues, resetForm } = useForm({
    validationSchema: formSchema,
    initialValues: {
        id: 0,
        name: '',
        server_id: '',
        discord_id: '',
    },
});

watch(
    () => props.player,
    (newItem) => {
        if (newItem) {
            setValues({
                id: newItem.id,
                name: newItem.name,
                server_id: String(newItem.server_id),
                discord_id: String(newItem.discord_id),
            });
        }
    },
    { immediate: true }
);


const onSubmit = handleSubmit((values) => {
    console.log('Отправка данных:', { ...values, id: props.player?.id });

    if (props.isAdd) {
        router.post(route('players.store'), values );
    } else {
        updatePlayer(values?.id, values)
    }

    isOpen.value = false;
    resetForm();
});

const updatePlayer = (player: number | undefined, values: object) => {
    router.patch(route('players.update', player), values, {
        onSuccess: () => {
            console.log('Игрок обновлен');
        },
        onError: (errors) => {
            console.error(errors);
        }
    })
}

</script>
