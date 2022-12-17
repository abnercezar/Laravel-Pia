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
import Select from '@/Components/Select.vue';

const props = defineProps({
    atendimento: Object,
    irmas: Object,
    atendimentoTipos: Array,
});

onMounted(() => {
    if (props.atendimento)
        createData.name = props.atendimento.name;
});

const createData = useForm({
    tipo: '0',
    valor: '0',
    irma_id: '0',
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
                        <InputLabel for="tipo" value="Tipo"/>

                        <Select :value="createData.tipo" @change="createData.tipo=$event">
                            <option value="0" selected>Selecione o tipo</option>
                            <option :value="tipo.value" v-for="(tipo, index) in atendimentoTipos" :key="index">{{tipo.label}}</option>
                        </Select>
                        
                        <InputError class="mt-2" :message="createData.errors.tipo" />
                    </div>

                    <div>
                        <InputLabel for="tipo" value="Irmã"/>

                        <Select :value="createData.irma_id" @change="createData.irma_id=$event">
                            <option value="0" selected>Selecione a irmã</option>
                            <option :value="irma.id" v-for="(irma, index) in irmas.data" :key="index">{{irma.name}}</option>
                        </Select>
                        
                        <InputError class="mt-2" :message="createData.errors.irma_id" />
                    </div>

                    <div>
                        <InputLabel for="tipo" value="Valor"/>

                        <TextInput class="border p-2" v-model="createData.valor" />
                        
                        <InputError class="mt-2" :message="createData.errors.valor" />
                    </div>
                    <PrimaryButton class="mt-2" @click="storeOrUpdate" :class="{ 'opacity-25': createData.processing }" :disabled="createData.processing">
                        Salvar
                    </PrimaryButton>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
