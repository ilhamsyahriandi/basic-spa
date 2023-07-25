<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm, usePage, Link } from "@inertiajs/vue3";

const props = defineProps({
    employees: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({});

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('employees.destroy', id));
    }
}
</script>

<template>
    <div class="">
        <div
            class="pr-3 m-3 bg-slate-100 grid grid-cols-5 relative overflow-x-auto border border-gray-300 shadow-sm shadow-gray-300 rounded-md">
            <div v-for="employee in employees" :key="employee.id">
                <Link :href="route('employees.show', employee.id)">
                <div class="ml-3 my-3 bg-white h-24 flex border border-gray-300 shadow-sm shadow-gray-300">
                    <div
                        class="bg-emerald-400 h-24 w-24 rounded-l-[30px] rounded-tr-[30px] border-[1px] border-emerald-500">
                    </div>
                    <div class="text-sm mx-4 my-2">
                        <div class="font-semibold"> {{ employee.name }}</div>
                        <div class="text-gray-500"> {{ employee.position.name }}</div>
                        <div class="mt-1 font-extralight text-gray-500 text-xs"> {{ employee.email }}</div>
                        <div class="font-extralight text-gray-500 text-xs"> {{ employee.work_mobile }}</div>
                    </div>
                </div>
                </Link>
            </div>
        </div>
    </div>
</template>
