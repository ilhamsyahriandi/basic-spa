<script setup>
import Navigation from '@/Layouts/Navigation.vue';
import FormLayout from '@/Pages/Department/Layouts/Form.vue';

const props = defineProps({
    department: {
        type: Object,
        default: () => ({}),
    },
    employees: {
        type: Object,
        default: () => ({}),
    },
    allDepartments: {
        type: Object,
        default: () => [],
    },
});

</script>

<template>
    <Navigation title="Department">
        <template #header>
            <div>
                <h3 class="text-xl leading-tight pb-3 text-[#7a61ab]">
                    Department <span class="text-slate-400"> / Edit</span>
                </h3>
            </div>
        </template>
        <FormLayout :department="department" :employees="employees" :allDepartments="allDepartments"></FormLayout>
    </Navigation>
</template>