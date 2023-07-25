<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm, usePage, Link } from "@inertiajs/vue3";

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
    <div class="">
        <div
            class="pr-3 m-3 bg-slate-100 grid grid-cols-4 relative overflow-x-auto border border-gray-300 shadow-sm shadow-gray-300 rounded-md">
            <div v-for="department in departments" :key="department.id">
                <div class="ml-3 my-3 bg-white h-[138px]  border border-gray-300 shadow-sm shadow-gray-300">
                    <div class="text-sm mx-4 my-2">
                        <div class="font-semibold text-lg text-[#71629f]">
                            <Link :href="route('departments.show', department.id)"> {{ department.name }} </Link>
                        </div>
                        <!-- <div class="bg-[#71629f] 
                        hover:bg-[#5a4e7e]
                        border border-transparent 
                        rounded-[4px] font-semibold 
                        text-xs  
                        uppercase tracking-widest 
                        transition ease-in-out duration-150                
                        align-middle mt-4 py-[6px] px-2 text-white text-center">
                            {{ department.employees_count }} employees
                        </div> -->
                    </div>
                    <div class="bg-[#71629f]
                        hover:bg-[#5a4e7e]
                        border border-transparent 
                        rounded-[4px] font-semibold 
                        text-xs  
                        uppercase tracking-widest 
                        transition ease-in-out duration-150                
                        align-middle mt-4 py-[6px] px-2 mx-4 
                        text-white text-center w-28">
                        {{ department.employees_count }} employees
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
