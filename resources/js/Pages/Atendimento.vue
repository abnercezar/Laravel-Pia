<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3';
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
    atendimentos: Object
});

const deleteForm = useForm({});
const show = ref(false);
const model = ref(null);

function showDeleteModal(atendimento)
{
    model.value = atendimento;
    show.value = true;
}

function closeDeleteModal()
{
    model.value = null;
    show.value = false;
}

function deletaratendimento() 
{
    if (model.value)
        deleteForm.delete(route('atendimentos.destroy', model.value.id));
    closeDeleteModal();
} 

function showCreateForm()
{
    Inertia.get(route('atendimentos.create'));   
}

function showEditForm(id)
{
    Inertia.get(route('atendimentos.edit', id));
}

</script>

<template>
    <Head title="Atendimentos" />

    <AuthenticatedLayout>
        <template #header>
            <div class="w-full flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lista de Atendimentos</h2>
                <span class="text-sm text-blue-400">{{ $page.props.flash.message }}</span>
                <PrimaryButton @click="showCreateForm">
                    Novo
                </PrimaryButton>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="grid grid-cols-12 rounded-lg shadow-sm border p-2 mb-2"
                        v-for="atendimento in atendimentos.data" :key="atendimento.id">
                        <span class="col-span-10">
                            {{ atendimento.name }}
                        </span>
                        <span class="cursor-pointer text-blue-400" @click="showEditForm(atendimento)">Edit</span>
                        <span class="cursor-pointer text-red-400" @click="showDeleteModal(atendimento)">Delete</span>
                    </div>
                </div>
            </div>
        </div>

        <Modal :show="show" @close="closeDeleteModal">
            <div class="p-4">
                <span>Deseja deletar a atendimento {{ model?.name }}?</span>
                <div class="flex flex-row-reverse mt-2 w-full">
                    <DangerButton @click="deletaratendimento">
                        Deletar
                    </DangerButton>
                    <SecondaryButton class="mr-2" @click="closeDeleteModal" :class="{ 'opacity-25': deleteForm.processing }" :disabled="deleteForm.processing">
                        Cancelar
                    </SecondaryButton>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
