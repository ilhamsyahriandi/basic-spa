<script setup>
import Navigation from '@/Layouts/Navigation.vue';
import ListLayout from '@/Pages/JobPosition/Layouts/List.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import CreateButton from '@/Components/CreateButton.vue';

const props = defineProps({
    positions: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({});


</script>


<template>
    <Navigation title="Positions">
        <template #header>
            <div>
                <h2 class="
                    text-gray-500
                    font-medium
                    text-xl
                    ">
                    Job Position
                </h2>
                <Link :href="route('job-positions.create')">
                <CreateButton @click="create = !create" :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    <span class="text-sm mx-auto font-bold">NEW</span>
                </CreateButton>
                </Link>
            </div>
        </template>
        <ListLayout v-bind="$props"></ListLayout>
    </Navigation>
</template>