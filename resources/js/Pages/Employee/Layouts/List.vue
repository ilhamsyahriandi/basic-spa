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
    <div class="relative overflow-x-auto m-4 border border-gray-300 shadow-sm shadow-gray-300 rounded-md">
        <table class="w-full text-sm text-left">
            <thead class="text-gray-700 bg-gray-200">
                <tr>
                    <th scope="col" class="p-2 border-x-[1px] border-gray-300">
                        <div class="flex items-center">
                            <Checkbox></Checkbox>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-2 border-x-[1px] border-gray-300">
                        Employee Name
                    </th>
                    <th scope="col" class="px-6 py-2 border-x-[1px] border-gray-300">
                        Work Phone
                    </th>
                    <th scope="col" class="px-6 py-2 border-x-[1px] border-gray-300">
                        Work Email
                    </th>
                    <th scope="col" class="px-6 py-2 border-x-[1px] border-gray-300">
                        Activities
                    </th>
                    <th scope="col" class="px-6 py-2 border-x-[1px] border-gray-300">
                        Next Activity Deadline
                    </th>
                    <th scope="col" class="px-6 py-2 border-x-[1px] border-gray-300">
                        Department
                    </th>
                    <th scope="col" class="px-6 py-2 border-x-[1px] border-gray-300">
                        Job Position
                    </th>
                    <th scope="col" class="px-6 py-2 border-x-[1px] border-gray-300">
                        Manager
                    </th>
                    <th scope="col" class="px-6 py-2 border-x-[1px] border-gray-300 text-center">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="employee in employees" :key="employee.id" class="border-b bg-white ">
                    <td class="w-4 p-2">
                        <div class="flex items-center">
                            <Checkbox></Checkbox>
                        </div>
                    </td>
                    <td scope="row" class="px-6 py-2 font-normal">
                        {{ employee.name }}
                    </td>
                    <td class="px-6 py-2">
                        {{ employee.work_mobile }}
                    </td>
                    <td class="px-6 py-2">
                        {{ employee.email }}
                    </td>
                    <td class="px-6 py-2">
                        xx
                    </td>
                    <td class="px-6 py-2">
                        xx
                    </td>
                    <td class="px-6 py-2">
                        {{ employee.department.name }}
                    </td>
                    <td class="px-6 py-2">
                        {{ employee.position.name }}
                    </td>
                    <td class="px-6 py-2">
                        {{ employee.manager?.name }}
                    </td>
                    <td class="px-6 py-2 flex justify-center align-middle gap-2">
                        <Link :href="route(
                            'employees.show',
                            employee.id)" class="text-gray-400 hover:text-gray-600">
                        View
                        </Link>
                        <Link :href="route(
                            'employees.edit',
                            employee.id)" class="text-blue-600 hover:text-blue-900">
                        Edit
                        </Link>
                        <Link @click="destroy(employee.id)" class="text-red-400 hover:text-red-600">
                        Delete
                        </Link>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</template>