<script setup>
import Navigation from '@/Layouts/Navigation.vue';
import FormLayout from '@/Pages/JobPosition/Layouts/Form.vue';

const props = defineProps({
    position: {
        type: Object,
        default: () => ({}),
    },
    departments: {
        type: Object,
        default: () => ({}),
    },
});

</script>

<template>
    <Navigation title="Position">
        <template #header>
            <div>
                <h3 class="text-xl leading-tight pb-3 text-[#7a61ab]">
                    Job Position <span class="text-slate-400"> / Edit</span>
                </h3>
            </div>
        </template>
        <FormLayout :position="position" :departments="departments" readonly></FormLayout>
    </Navigation>
</template>
