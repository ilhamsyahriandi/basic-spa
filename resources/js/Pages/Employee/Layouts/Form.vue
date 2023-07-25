<script setup>
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import axios from 'axios';
import { computed, onMounted, ref, watch } from 'vue';

const props = defineProps({
    employee: {
        type: Object,
        default: () => ({}),
    },

    // positions: {
    //     type: Object,
    //     default: () => ({}),
    // },

    departments: {
        type: Object,
        default: () => ({}),
    },

    allEmployees: {
        type: Object,
        default: () => [],
    },

    readonly: {
        type: Boolean,
        default: false,
    }

});

const form = useForm("Create", {
    id: props.employee.id ?? 0,
    name: props.employee.name ?? '',
    email: props.employee.email ?? '',
    work_mobile: props.employee.work_mobile ?? '',
    work_phone: props.employee.work_phone ?? '',
    job_position_id: props.employee.job_position_id ?? '',
    department_id: props.employee.department_id ?? '',
    manager_id: props.employee.manager_id ?? '',
    coach_id: props.employee.coach_id ?? '',
});

const submit = () => {
    if (form.id === 0) {
        form.post(route("employees.store"), {
            onSuccess: () => {
                form.reset()
                delete form.id
            }
        });
    }
    else {
        form.put(route("employees.update", props.employee.id));
    }
};

const buttonLabel = computed(() => {
    return form.id === 0 ? 'create' : 'update'
})

const positions = ref([])
const managers = ref([])
const coachs = ref([])

watch(() => form.department_id, (value) => {
    axios.get('/api/job-positions?department_id=' + value)
        .then((response) => {
            // console.log(response.data)
            positions.value = response.data

            // form.id === 0 ? '' : form.job_position_id = ''
            form.job_position_id = ''
        })
})

onMounted(() => {
    axios.get('/api/job-positions?department_id=' + props.employee.department_id)
        .then((response) => {
            positions.value = response.data
        })
})

</script>

<template>
    <div class=" flex justify-center h-screen bg-slate-200">
        <div class="m-4 w-screen h-3/4 bg-white border border-gray-400 shadow-sm shadow-gray-300 rounded-md">
            <div class="bg grid grid-cols-8 border-b-[1px] border-gray-400 h-12">
                <div class="col-span-4 border-r-[1px] border-gray-400 flex items-center"></div>
                <div class="border-r-[1px] border-gray-400 flex items-center justify-center">ppp</div>
                <div class="border-r-[1px] border-gray-400 flex items-center justify-center">ppp</div>
                <div class="border-r-[1px] border-gray-400 flex items-center justify-center">ppp</div>
                <div class="flex items-center justify-center">ppp</div>
            </div>
            <form @submit.prevent="submit">
                <div class="mx-9 grid grid-cols-1 ">
                    <div class="">
                        <TextInput type="text" id="name" v-model="form.name" :disabled="readonly"
                            class="border-0 h-12 w-3/4 text-3xl hover:border-b-[1px] focus:border-slate-500 placeholder-slate-300"
                            placeholder="Employee's Name"></TextInput>
                        <InputError :message="form.errors.name" class="text-red-600 text-right w-3/4">{{
                            form.errors.name }}
                        </InputError>
                    </div>
                    <div class="mt-8 grid grid-rows-1 grid-flow-col ">
                        <div>
                            <select type="text" id="department" v-model="form.department_id" :disabled="readonly"
                                class="border-0 text-xl h-12 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500">
                                <option value="" disabled>Select Department</option>
                                <option v-for="department in departments" v-bind:value="department.id">
                                    {{ department.name }}
                                </option>
                            </select>
                            <InputError :message="form.errors.department_id" class="text-red-600 text-right w-full">{{
                                form.errors.department_id }}
                            </InputError>
                        </div>
                        <div>
                            <select type="text" id="job_position" v-model="form.job_position_id" :disabled="readonly"
                                class="border-0 text-xl h-12 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500">
                                <option value="" disabled>Select Job Position</option>
                                <option v-for="position in positions" v-bind:value="position.id">
                                    {{ position.name }}
                                </option>
                            </select>
                            <InputError :message="form.errors.job_position_id" class="text-red-600 text-right w-full">{{
                                form.errors.job_position_id }}
                            </InputError>
                        </div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="grid grid-rows-4 grid-flow-col mt-10">
                            <div class="mx-3 w-1/2">
                                <h3>1ss</h3>
                                <hr>
                            </div>
                            <div class="mx-3 text-sm font-medium flex items-center h-10">
                                <InputLabel class="w-24" font-bold>Work Mobile </InputLabel>
                                <TextInput type="text" id="work_mobile" v-model="form.work_mobile" :disabled="readonly"
                                    class="border-0 w-3/4 h-7 hover:border-b-[1px]">
                                </TextInput>
                            </div>
                            <div class="mx-3 text-sm font-medium flex items-center h-10">
                                <InputLabel class="w-24" font-bold>Work Phone </InputLabel>
                                <TextInput type="text" id="work_phone" v-model="form.work_phone" :disabled="readonly"
                                    class="border-0 w-3/4 h-7 hover:border-b-[1px]">
                                </TextInput>
                            </div>
                            <div class="">
                                <div class="mx-3 text-sm font-medium flex items-center h-10">
                                    <InputLabel class="w-24" font-bold>Work Email </InputLabel>
                                    <TextInput type="text" id="email" v-model="form.email" :disabled="readonly"
                                        class="border-0 w-3/4 h-7 hover:border-b-[1px]">
                                    </TextInput>
                                </div>
                                <InputError :message="form.errors.email" class="text-red-600 text-right mx-3">{{
                                    form.errors.email
                                }}
                                </InputError>
                            </div>
                        </div>
                        <div class="grid grid-rows-4 grid-flow-col mt-10">

                            <div class="mx-3 h-10">
                                <h3>sasas</h3>
                                <hr>
                            </div>
                            <div class="mx-3 text-sm font-medium flex items-center h-10">
                                <InputLabel class="w-36 font-bold">Manager </InputLabel>
                                <select type="text" id="manager" v-model="form.manager_id" :disabled="readonly"
                                    class="border-0 h-10 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500 text-sm font-thin">
                                    <!-- <option disabled selected class="text-sm" v-bind:value="''">Select Manager</option> -->
                                    <option v-for="oneEmployee in allEmployees" v-bind:value="oneEmployee.id">
                                        {{ oneEmployee.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="mx-3 text-sm font-medium flex items-center h-10">
                                <InputLabel class="w-36 font-bold">Coach </InputLabel>
                                <select type="text" id="manager" v-model="form.coach_id" :disabled="readonly"
                                    class="border-0 h-10 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500 text-sm font-thin">
                                    <option v-for="oneEmployee in allEmployees" v-bind:value="oneEmployee.id">
                                        {{ oneEmployee.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-20">
                        <PrimaryButton class="bg-[#7a61ab] text-white px-3 py-2 rounded-lg absolute right-20"
                            :class="{ 'opacity-25': form.processing }" :disabled="form.processing" v-if="!readonly">
                            {{ buttonLabel }}
                        </PrimaryButton>

                        <div class="grid grid-cols-2 gap-2 mx-4" v-if="readonly">
                            <Link :href="route('employees.index')"
                                class="bg-[#7a61ab] hover:bg-[#5f4d95] text-white px-3 py-2 rounded-lg text-center">
                            Back
                            </Link>
                            <Link :href="route(
                                'employees.edit',
                                employee.id)"
                                class="bg-[#7a61ab] hover:bg-[#5f4d95] text-white px-3 py-2 rounded-lg text-center">
                            Edit
                            </Link>
                        </div>
                    </div>
                </div>
                <!-- <div class="mx-9 text-sm font-medium flex items-center h-7">
                    <InputLabel class="w-36 font-boldfont-thin text-slate-600">Work Information </InputLabel>
                </div>
                <div class="my-3 grid grid-rows-3 grid-flow-col gap-2">
                    <div class="mx-9 text-sm font-medium flex items-center h-7">
                        <InputLabel class="text-slate-700 w-full border-b-2 uppercase text-xs font-extrabold">Location</InputLabel>
                    </div>
                    <div class="mx-9 text-sm font-medium flex items-center h-7">
                        <InputLabel class="w-36 font-bold">Work Address </InputLabel>
                        <input type="text"
                            class="border-0 focus:ring-0 focus:border-slate-500 h-7 w-full hover:border-b-[1px]">
                    </div>
                    <div class="mx-9 text-sm font-medium flex items-center h-7">
                        <InputLabel class="w-36 font-bold">Work Location</InputLabel>
                        <input type="text"
                            class="border-0 focus:ring-0 focus:border-slate-500 h-7 w-full hover:border-b-[1px]">
                    </div>
                </div>
                <div class="my-3 grid grid-rows-4 grid-flow-col gap-2">
                    <div class="mx-9 text-sm font-medium flex items-center h-7">
                        <InputLabel class="text-slate-700 w-full border-b-2 uppercase text-xs font-extrabold">Schedule</InputLabel>
                    </div>
                    <div class="mx-9 text-sm font-medium flex items-center h-7">
                        <InputLabel class="w-36 font-bold">Working Hours</InputLabel>
                        <input type="text"
                            class="border-0 h-7 w-1/6 hover:border-b-[1px] focus:ring-0 focus:border-slate-500">
                    </div>
                </div>
                </div> -->
                <!-- <div>
                    <div class="flex justify-end">
                        <button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                            class="bg-[#7a61ab] text-white px-3 py-2 rounded-lg absolute right-20">Save</button>
                    </div>
                </div> -->



            </form>
        </div>
    </div>
</template>