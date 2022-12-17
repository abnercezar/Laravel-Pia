<script setup>
import { ref, watch } from 'vue';

const props = defineProps(['value']);

const emit = defineEmits(['change']);

const selected = ref(props.value);

watch(() => props.value, (val) => selected.value = val)

function changeSelect () {
    emit(`change`, selected.value);
}

</script>

<template>
    <select
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        v-model="selected"
        @change="changeSelect()"
    >
        <slot></slot>
    </select>
</template>
