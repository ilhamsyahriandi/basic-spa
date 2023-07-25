<script setup>
import Navigation from '@/Layouts/Navigation.vue';
import FormLayout from '@/Pages/Employee/Layouts/Form.vue';

defineProps({
    // positions: {
    //     type: Object,
    //     default: () => ({}),
    // },
    employee: {
        type: Object,
        default: () => ({}),
    },

    departments: {
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
            ">Employees <span class="text-slate-400"> / Edit</span></h2>
        </template>
        <FormLayout :employee="employee" :all-employees="allEmployees" :departments="departments">

        </FormLayout>
    </Navigation>
</template>