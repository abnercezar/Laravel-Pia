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
    comuns: Object
});

const deleteForm = useForm({});
const show = ref(false);
const model = ref(null);

function showDeleteModal(comum)
{
    model.value = comum;
    show.value = true;
}

function closeDeleteModal()
{
    model.value = null;
    show.value = false;
}

function deletarComum() 
{
    if (model.value)
        deleteForm.delete(route('comums.destroy', model.value.id));
    closeDeleteModal();
} 

function showCreateForm()
{
    Inertia.get(route('comums.create'));   
}

function showEditForm(id)
{
    Inertia.get(route('comums.edit', id));
}

</script>

<template>
    <Head title="Comum" />

    <AuthenticatedLayout>
        <template #header>
            <div class="w-full flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lista de Comuns</h2>
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
                        v-for="comum in comuns.data" :key="comum.id">
                        <span class="col-span-10">
                            {{ comum.name }}
                        </span>
                        <span class="cursor-pointer text-blue-400" @click="showEditForm(comum)">Edit</span>
                        <span class="cursor-pointer text-red-400" @click="showDeleteModal(comum)">Delete</span>
                    </div>
                </div>
            </div>
        </div>

        <Modal :show="show" @close="closeDeleteModal">
            <div class="p-4">
                <span>Deseja deletar a comum {{model?.name}}?</span>
                <div class="flex flex-row-reverse mt-2 w-full">
                    <DangerButton @click="deletarComum">
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
