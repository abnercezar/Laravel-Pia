<script setup>
import { onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    atendimento: Object
});

onMounted(() => {
    if (props.atendimento)
        createData.name = props.atendimento.name;
});

const createData = useForm({
    name: ''
});

function voltar()
{
    Inertia.get(route('atendimentos.index'));
}

function storeOrUpdate()
{
    if (props.atendimento) 
        createData.put(route('atendimentos.update', props.atendimento.id));
    else
        createData.post(route('atendimentos.store'));
}
</script>

<template>
    <Head title="atendimento" />

    <AuthenticatedLayout>
        <template #header>
            <div class="w-full flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{atendimento ? 'Editar atendimento ' + atendimento.name : 'Criar nova atendimento' }}
                </h2>
                <PrimaryButton @click="voltar">
                    Voltar
                </PrimaryButton>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div>
                        <InputLabel for="name" value="Nome da atendimento"/>
                        <TextInput class="border p-2" v-model="createData.name" />
                        <InputError class="mt-2" :message="createData.errors.name" />
                    </div>
                    <PrimaryButton class="mt-2" @click="storeOrUpdate" :class="{ 'opacity-25': createData.processing }" :disabled="createData.processing">
                        Salvar
                    </PrimaryButton>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
