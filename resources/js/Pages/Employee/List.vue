<script setup>
import Navigation from '@/Layouts/Navigation.vue';
import ListLayout from '@/Pages/Employee/Layouts/List.vue';
import Signboard from '@/Pages/Employee/Components/Signboard.vue';
import { useForm, usePage, Link } from "@inertiajs/vue3";
import CreateButton from '@/Components/CreateButton.vue';
import IconList from './Components/ApplicationIconList.vue';
import IconSignboard from './Components/ApplicationIconSignboard.vue';
import { ref } from 'vue';

const props = defineProps({
    employees: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({});

const tableLayout = ref('signboard')

</script>

<template>
    <!-- <div class="bg-rose-600"> -->
    <Navigation>
        <template #header>
            <h2 class="
            text-gray-500
            font-medium
            text-xl
            ">Employees</h2>

            <div class="w-full flex justify-between">
                <Link :href="route('employees.create')">
                <CreateButton @click="create = !create" :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    <span class="text-sm mx-auto font-bold">NEW</span>
                </CreateButton>
                </Link>

                <div class="grid grid-cols-2">
                    <div class="p-2 mt-1 flex items-center hover:bg-gray-100" @click="tableLayout = 'signboard'">
                        <IconSignboard class="mt-1"></IconSignboard>
                    </div>
                    <div class="p-2 mt-1 flex items-center hover:bg-gray-100" @click="tableLayout = 'list'">
                        <IconList></IconList>
                    </div>
                </div>
            </div>
        </template>

        <Signboard v-bind="$props" v-if="tableLayout === 'signboard'"></Signboard>
        <ListLayout v-bind="$props" v-if="tableLayout === 'list'"></ListLayout>
    </Navigation>
    <!-- </div> -->
</template>