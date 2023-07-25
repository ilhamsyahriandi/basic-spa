<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import Checkbox from '@/Components/Checkbox.vue';


const props = defineProps({
    positions: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({});

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('job-positions.destroy', id));
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
                        <div class="ml-4">Job Position</div>
                    </th>
                    <th scope="col" class="px-6 py-2 border-x-[1px] border-gray-300">Department</th>
                    <th scope="col" class="px-6 py-2 border-x-[1px] border-gray-300">Level</th>
                    <th scope="col" class="px-6 py-2 border-x-[1px] border-gray-300 text-center">Actions</th>

                </tr>
            </thead>
            <tbody>
                <tr v-for="position in positions" :key="position.id" class="bg-white border-b text-sm">
                    <td class="w-4 p-2">
                        <div class="flex items-center">
                            <Checkbox></Checkbox>
                        </div>
                    </td>
                    <td class="px-6 py-2 text-left font-normal">
                        <div class="ml-4">{{ position.name }}</div>
                    </td>
                    <td class="px-6 py-2 text-left">{{ position.department.name }}</td>
                    <td class="px-6 py-2 text-left">{{ position.level }}</td>
                    <td class="px-6 py-2 flex justify-center align-middle gap-2">
                        <Link :href="route(
                            'job-positions.show',
                            position.id)" class="text-gray-400 hover:text-gray-600">
                        View
                        </Link>
                        <Link :href="route('job-positions.edit', position.id)" class="text-blue-600 hover:text-blue-900">
                        Edit</Link>
                        <Link @click="destroy(position.id)" class="text-red-400 hover:text-red-600">
                        Delete
                        </Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>