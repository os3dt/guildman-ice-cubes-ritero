<script setup>

import {computed, ref, watch} from "vue";
import {useForm} from "@inertiajs/vue3";
import SideForm from "@/Components/Sidepage/SideForm.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectDBInput from "@/Components/Inputs/SelectDBInput.vue";

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
    one_item: null,
    one_stack: null,
    one_shulker: null,
    trader: null,
})

const fillForm = () => {
    form._method = editMode.value ? 'patch' : 'post'
    form.db_item_id =  getModelValueForForm('db_item_id', '')
    form.one_item =    String(getModelValueForForm('one_item', ''))
    form.one_stack =   String(getModelValueForForm('one_stack', ''))
    form.one_shulker = String(getModelValueForForm('one_shulker', ''))
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
    form.post(editMode.value ? route('products-cost.update', props.modelValue.id) : route('products-cost.store'), {
        onSuccess: onClose
    })
}
</script>

<template>
    <SideForm
        title="Создание записи о продавце"
        :model-value="!!modelValue"
        @close="onClose"
    >
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
                <InputLabel for="one_stack" value="Цена за штуку" />
                <TextInput id="one_stack" class="mt-1 block w-full" v-model="form.one_item" placeholder="Цена за штуку" />
                <InputError class="mt-2" :message="form.errors.one_item" />
            </div>

            <div>
                <InputLabel for="one_stack" value="Цена за стак" />
                <TextInput id="one_stack" class="mt-1 block w-full" v-model="form.one_stack" placeholder="Цена за штуку" />
                <InputError class="mt-2" :message="form.errors.one_stack" />
            </div>

            <div>
                <InputLabel for="one_shulker" value="Цена за шалкер" />
                <TextInput id="one_shulker" class="mt-1 block w-full" v-model="form.one_shulker" placeholder="Цена за шалкер" />
                <InputError class="mt-2" :message="form.errors.one_shulker" />
            </div>

            <div>
                <InputLabel for="trader" value="Продавец" />
                <TextInput id="trader" class="mt-1 block w-full" v-model="form.trader" placeholder="Продавец" />
                <InputError class="mt-2" :message="form.errors.trader" />
            </div>
        </div>

        <template v-slot:footer-btn>
            <PrimaryButton @click="onSave">Сохранить</PrimaryButton>
        </template>

    </SideForm>
</template>
