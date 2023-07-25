<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';


const props = defineProps({
    department: {
        type: Object,
        default: () => ({}),
    },
    employees: {
        type: Object,
        default: () => ({}),
    },
    readonly: {
        type: Boolean,
        default: false,
    },
    allDepartments: {
        type: Object,
        default: () => [],
    },
});

const form = useForm("Create", {
    id: props.department.id ?? 0,
    name: props.department.name ?? '',
    manager_id: props.department.manager_id ?? '',
    parent_id: props.department.parent_id ?? '',
});

const submit = () => {
    if (form.id === 0) {
        form.post(route("departments.store"), {
            onSuccess: () => {
                form.reset()
                delete form.id
            }
        });
    }
    else {
        form.put(route("departments.update", props.department.id));
    }
};

const buttonLabel = computed(() => {
    return form.id === 0 ? 'create' : 'update'
})


</script>

<template>
    <div class="flex items-center">
        <div class="m-4 w-screen h-3/4 bg-white border border-gray-400 shadow-sm shadow-gray-300 rounded-md">
            <div class="bg grid grid-cols-8 border-b-[1px] border-gray-400 h-12">
                <div class="col-span-4 border-r-[1px] border-gray-400 flex items-center"></div>
                <div class="border-r-[1px] border-gray-400 flex items-center justify-center">ppp</div>
                <div class="border-r-[1px] border-gray-400 flex items-center justify-center">ppp</div>
                <div class="border-r-[1px] border-gray-400 flex items-center justify-center">ppp</div>
                <div class="flex items-center justify-center">ppp</div>
            </div>
            <form @submit.prevent="submit" class="w-full">
                <div class="my-3 grid grid-rows-4 grid-flow-col gap-0 ">
                    <div>
                        <div class="mx-9 text-sm font-medium flex items-center">
                            <InputLabel class="w-36 font-medium">Department Name </InputLabel>
                            <TextInput id="name" v-model="form.name" type="text" :disabled="readonly"
                                class="border-0 h-10 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500 font-thin text-sm">
                            </TextInput>
                        </div>
                        <InputError :message="form.errors.name" class="text-red-600 text-right mx-9">{{
                            form.errors.name
                        }}
                        </InputError>
                    </div>
                    <div class="mx-9 grid grid-cols-2 gap-6">
                        <div>
                            <div class="text-sm font-medium flex items-center">
                                <InputLabel class="w-36 font-medium">Manager </InputLabel>
                                <select type="text" id="employees" v-model="form.manager_id" :disabled="readonly"
                                    class="border-0 h-10 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500 text-sm font-thin ml-4">
                                    <option disabled selected class="text-sm">Select Manager</option>
                                    <option v-for="employee in employees" v-bind:value="employee.id">
                                        {{ employee.name }}
                                    </option>
                                </select>
                            </div>
                            <InputError :message="form.errors.manager_id" class="text-red-600 text-right mx-3">{{
                                form.errors.manager_id
                            }}
                            </InputError>
                        </div>
                        <div class=" text-sm font-medium flex items-center">
                            <InputLabel class="w-36 font-medium">Parent Department </InputLabel>
                            <select type="text" id="departments" v-model="form.parent_id" :disabled="readonly"
                                class="border-0 text-sm h-10 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500 font-thin">
                                <option disabled selected class="text-sm border-0">Select Parent Department</option>
                                <option v-for="oneDepartment in allDepartments" v-bind:value="oneDepartment.id"
                                    class="text-sm border-0">
                                    {{ oneDepartment.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end mt-20">
                        <PrimaryButton class="bg-[#7a61ab] text-white px-3 py-2 rounded-lg absolute right-20"
                            :class="{ 'opacity-25': form.processing }" :disabled="form.processing" v-if="!readonly">
                            {{ buttonLabel }}
                        </PrimaryButton>
                        <div class="grid grid-cols-2 gap-2 mx-4" v-if="readonly">
                            <Link :href="route('departments.index')"
                                class="bg-[#7a61ab] hover:bg-[#5f4d95] text-white px-3 py-2 rounded-lg text-center">
                            Back
                            </Link>
                            <Link :href="route(
                                'departments.edit',
                                department.id)"
                                class="bg-[#7a61ab] hover:bg-[#5f4d95] text-white px-3 py-2 rounded-lg text-center">
                            Edit
                            </Link>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>