<script setup>

import SideForm from "@/Components/Sidepage/SideForm.vue";
import {ref, watch} from "vue";
import {useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    modelValue: {
        type: [Boolean, Object],
        required: false,
        default: false,
    }
})

const emit = defineEmits(['update:modelValue'])
const editMode = ref(props.modelValue && typeof props.modelValue === 'object')
const getModelValueForForm = (prop, defValue = null) => {
    return editMode.value ? props.modelValue[prop] : defValue
}

const form = useForm({
    _method: 'post',
    name: null,
    icon: null,
    stack: null,
})

const fillForm = () => {
    form._method = editMode.value ? 'patch' : 'post'
    form.name = getModelValueForForm('name', '')
    form.icon = getModelValueForForm('icon', '')
    form.stack = String(getModelValueForForm('stack', ''))
}

watch(
    () => props.modelValue,
    () => {
        editMode.value = props.modelValue && typeof props.modelValue === 'object'
        fillForm()
    }
)

const onClose = () => {
    emit('update:modelValue', false)
}

const onSave = () => {
    form.post(editMode.value ? route('minecraft-db.update', props.modelValue.id) : route('minecraft-db.store'), {
        onSuccess: onClose
    })
}
</script>

<template>
    <SideForm
        title="Создание блока / предмета в базе"
        :model-value="!!modelValue"
        @close="onClose"
    >
        <div class="flex flex-col gap-6">
            <div>
                <InputLabel for="name" value="Наименование предмета или блока" />
                <TextInput id="name" class="mt-1 block w-full" v-model="form.name" placeholder="Наименование предмета или блока" />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="icon" value="Иконка с вики" />
                <TextInput id="icon" class="mt-1 block w-full" v-model="form.icon" placeholder="Иконка с вики" />
                <InputError class="mt-2" :message="form.errors.icon" />
            </div>

            <div>
                <InputLabel for="stack" value="Стак предмета" />
                <TextInput id="stack" class="mt-1 block w-full" v-model="form.stack" placeholder="Стак предмета" />
                <InputError class="mt-2" :message="form.errors.stack" />
            </div>
        </div>

        <template v-slot:footer-btn>
            <PrimaryButton @click="onSave">Сохранить</PrimaryButton>
        </template>

    </SideForm>
</template>
