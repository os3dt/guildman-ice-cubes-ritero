<script setup>

import {ref, watch} from "vue";
import {useForm} from "@inertiajs/vue3";
import SideForm from "@/Components/Sidepage/SideForm.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SelectDBInput from "@/Components/Inputs/SelectDBInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    modelValue: {
        type: [Boolean, Object],
        required: false,
        default: false,
    },
    items: Object,
})

const emit = defineEmits(['update:modelValue'])
const editMode = ref(props.modelValue && typeof props.modelValue === 'object')
const getModelValueForForm = (prop, defValue = null) => {
    return editMode.value ? props.modelValue[prop] : defValue
}

const form = useForm({
    _method: 'post',
    db_item_id: null,
    one: null,
    stack: null,
    shulker: null,
})

const fillForm = () => {
    form._method = editMode.value ? 'patch' : 'post'
    form.db_item_id =  getModelValueForForm('db_item_id', '')
    form.one =         String(getModelValueForForm('one', ''))
    form.stack =       String(getModelValueForForm('stack', ''))
    form.shulker =     String(getModelValueForForm('shulker', ''))
    form.trader =      getModelValueForForm('trader', '')
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
    form.post(editMode.value ? route('price-ice.update', props.modelValue.id) : route('price-ice.store'), {
        onSuccess: onClose
    })
}
</script>

<template>
    <SideForm
        title="Создание расценки 🧊"
        :model-value="!!modelValue"
        @close="onClose">

        <div class="flex flex-col gap-6">
            <div>
                <InputLabel for="db_item_id" value="Цена за штуку" />
                <SelectDBInput
                    name="db_item_id"
                    class="mt-1 block w-full"
                    :items="items.data.map(item => ({ value: item.id, label: item.name, icon: item.icon }))"
                    v-model="form.db_item_id"
                />
                <InputError class="mt-2" :message="form.errors.db_item_id" />
            </div>

            <div>
                <InputLabel for="one" value="🧊 за штуку" />
                <TextInput id="one" class="mt-1 block w-full" v-model="form.one" placeholder="Кол-во" />
                <InputError class="mt-2" :message="form.errors.one" />
            </div>

            <div>
                <InputLabel for="stack" value="🧊 за стак" />
                <TextInput id="stack" class="mt-1 block w-full" v-model="form.stack" placeholder="Кол-во" />
                <InputError class="mt-2" :message="form.errors.stack" />
            </div>

            <div>
                <InputLabel for="shulker" value="🧊 за шалкер" />
                <TextInput id="shulker" class="mt-1 block w-full" v-model="form.shulker" placeholder="Кол-во" />
                <InputError class="mt-2" :message="form.errors.shulker" />
            </div>
        </div>

        <template v-slot:footer-btn>
            <PrimaryButton @click="onSave">Сохранить</PrimaryButton>
        </template>

    </SideForm>
</template>

