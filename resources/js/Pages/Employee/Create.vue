<script setup>
import Navigation from '@/Layouts/Navigation.vue';
import FormLayout from '@/Pages/Employee/Layouts/Form.vue';

const props = defineProps({
    // positions: {
    //     type: Object,
    //     default: () => ({}),
    // },

    departments: {
        type: Object,
        default: () => ({}),
    },
    employees: {
        type: Object,
        default: () => ({}),
    },

    allEmployees: {
        type: Object,
        default: () => [],
    },
});

</script>

<template>
    <Navigation>

        <template #header>
            <h2 class="
            text-gray-500
            font-medium
            text-lg
            ">Employees <span class="text-slate-400"> / Create</span></h2>
        </template>
        <FormLayout v-bind="$props">

        </FormLayout>
    </Navigation>
</template>