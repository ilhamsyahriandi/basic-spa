<script setup>
import Navigation from '@/Layouts/Navigation.vue';
import ListLayout from '@/Pages/Department/Layouts/List.vue';
import Signboard from '@/Pages/Department/Components/Signboard.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import CreateButton from '@/Components/CreateButton.vue';
import IconList from './Components/ApplicationIconList.vue';
import IconSignboard from './Components/ApplicationIconSignboard.vue';
import { ref } from 'vue';

const props = defineProps({
    departments: {
        type: Object,
        default: () => ({}),
    },
    employees: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({});

const tableLayout = ref('signboard')


</script>


<template>
    <Navigation title="Departments">
        <template #header>
            <div>
                <h2 class="
                    text-gray-500
                    font-medium
                    text-xl
                    ">
                    Department
                </h2>
                <div class="w-full flex justify-between">
                    <Link :href="route('departments.create')">
                    <CreateButton @click="create = !create" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
                        <span class="text-sm mx-auto font-bold">NEW</span>
                    </CreateButton>
                    </Link>

                    <div class="grid grid-cols-2">
                        <div class="px-1 mt-1 flex items-center hover:bg-gray-100" @click="tableLayout = 'signboard'">
                            <IconSignboard class="mt-1"></IconSignboard>
                        </div>
                        <div class="px-1 mt-1 flex items-center hover:bg-gray-100" @click="tableLayout = 'list'">
                            <IconList></IconList>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <Signboard v-bind="$props" v-if="tableLayout === 'signboard'"></Signboard>
        <ListLayout v-bind="$props" v-if="tableLayout === 'list'"></ListLayout>
    </Navigation>
</template>