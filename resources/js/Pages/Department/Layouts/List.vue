<script setup>
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm, usePage, Link } from "@inertiajs/vue3";
import Checkbox from '@/Components/Checkbox.vue';

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


function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('departments.destroy', id));
    }
}

</script>

<template>
    <div class="relative overflow-x-auto m-4 border border-gray-300 shadow-sm shadow-gray-300 rounded-md">
        <table class="w-full text-sm text-left">
            <thead class="text-gray-700 bg-gray-200">
                <tr class="">
                    <th scope="col" class="p-2 border-x-[1px] border-gray-300">
                        <div class="flex items-center">
                            <Checkbox></Checkbox>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-2 border-x-[1px] border-gray-300">
                        <div class="ml-4">Display Name</div>
                    </th>
                    <th scope="col" class="px-6 py-2 border-x-[1px] border-gray-300">Manager</th>
                    <th scope="col" class="px-6 py-2 border-x-[1px] border-gray-300">Employees</th>
                    <th scope="col" class="px-6 py-2 border-x-[1px] border-gray-300t">Parent Department</th>
                    <th scope="col" class="px-6 py-2 border-x-[1px] border-gray-300 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="department in departments" :key="department.id" class="bg-white border-b text-sm">
                    <td class="w-4 p-2">
                        <div class="flex items-center">
                            <Checkbox></Checkbox>
                        </div>
                    </td>
                    <td class="px-6 py-2 font-normal">
                        <div class="ml-4">{{ department.name }}</div>
                    </td>
                    <td class="px-6 py-2 text-left">{{ department.manager?.name }}</td>
                    <td class="px-6 py-2 text-left">{{ department.employees_count }}</td>
                    <td class="px-6 py-2 text-left">{{ department.parent?.name }}</td>
                    <td class="px-6 py-2 flex justify-center align-middle gap-2">
                        <Link :href="route(
                            'departments.show',
                            department.id)" class="text-gray-400 hover:text-gray-600">
                        View
                        </Link>
                        <Link :href="route(
                            'departments.edit',
                            department.id)" class="text-blue-600 hover:text-blue-900">
                        Edit
                        </Link>
                        <Link @click="destroy(department.id)" class="text-red-400 hover:text-red-600">
                        Delete
                        </Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>