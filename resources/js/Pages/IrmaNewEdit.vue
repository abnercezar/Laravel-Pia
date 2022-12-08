<script setup>
import { onMounted, ref, nextTick, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    irma: Object,
    comuns: [Array, Object],
});



const comunsList = ref(_.clone(props.comuns.data));
const comumId = ref('0');
const comunsSelecteds = computed(() => _.filter(props.comuns.data, (comum) => createData.comuns.indexOf(comum.id) > -1));

const contato = ref('');

const createData = useForm({
    name: '',
    cpf: '',
    comuns: [],
    contatos: [],
});

function voltar()
{
    Inertia.get(route('irmas.index'));
}

function storeOrUpdate()
{
    if (props.irma?.data) 
        createData.put(route('irmas.update', props.irma.data.id));
    else
        createData.post(route('irmas.store'));
}

function addComum()
{
    if (! createData.comuns.indexOf(comumId.value) > -1)
        createData.comuns.push(comumId.value);
    
    _.remove(comunsList.value, ['id', comumId.value])

    nextTick(() => {
        comumId.value = '0';
    });
}

function removeComum(id)
{
    _.remove(createData.comuns, (comumId) => comumId == id)
    
    const comum = _.find(props.comuns.data, ['id', id]);
    if (comum)
        comunsList.value.push(comum)

    nextTick(() => {
        comumId.value = '0';
    });
}

function addContato()
{
    createData.contatos.push({descricao: contato.value});
    contato.value = '';
}

function removeContato(index)
{
    createData.contatos.splice(index, 1);
    contato.value = '';
}

onMounted(() => {
    if (props.irma?.data){
        createData.name = props.irma.data.name;
        createData.cpf = props.irma.data.cpf;
        createData.comuns = _.map(props.irma.data.comuns, 'id')
        createData.contatos = _.clone(props.irma.data.contatos)

        comunsList.value = _.filter(props.comuns.data, (comum) => createData.comuns.indexOf(comum.id) === -1)
    }
});
</script>

<template>
    <Head title="irma" />

    <AuthenticatedLayout>
        <template #header>
            <div class="w-full flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{irma?.data ? 'Editar irma ' + irma.data.name : 'Criar nova irma' }}
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
                        <InputLabel for="name" value="Nome da irma"/>
                        <TextInput class="border p-2" v-model="createData.name" />
                        <InputError class="mt-2" :message="createData.errors.name" />
                    </div>
                    <div>
                        <InputLabel for="cpf" value="CPF"/>
                        <TextInput class="border p-2" v-model="createData.cpf" />
                        <InputError class="mt-2" :message="createData.errors.cpf" />
                    </div>
                    <div>
                        <InputLabel for="comum" value="Comuns"/>
                        
                        <div>
                            <select v-model="comumId">
                                <option value="0">Selecione a comum</option>
                                <option :value="item.id" v-for="item in _.sortBy(comunsList, 'name')" :key="item.id">{{item.name}}</option>
                            </select>
                            <PrimaryButton class="ml-2" @click="addComum()">Adicionar</PrimaryButton>
                        </div>

                        <InputError class="my-2" :message="createData.errors.comuns" />

                        <div class="flex py-2 items-center" v-for="comum in comunsSelecteds" :key="comum.id">
                            <span class="col-span-2">Nome: {{comum.name}}</span>
                            <SecondaryButton class="ml-2" @click="removeComum(comum.id)">Remover</SecondaryButton>
                        </div>

                    </div>

                    <div>
                        <InputLabel for="comum" value="Contatos"/>
                        
                        <div>
                            <TextInput class="border p-2" placeholder="Informe o contato" v-model="contato" />
                            <PrimaryButton class="ml-2" @click="addContato()">Adicionar</PrimaryButton>
                        </div>

                        <InputError class="my-2" :message="createData.errors.contatos" />

                        <div class="flex py-2 items-center" v-for="(contato, i) in createData.contatos" :key="i">
                            <span class="col-span-2">Contato: {{contato.descricao}}</span>
                            <SecondaryButton class="ml-2" @click="removeContato(i)">Remover</SecondaryButton>
                        </div>

                    </div>
                    <PrimaryButton class="mt-2" @click="storeOrUpdate" :class="{ 'opacity-25': createData.processing }" :disabled="createData.processing">
                        Salvar
                    </PrimaryButton>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
