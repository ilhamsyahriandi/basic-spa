<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { computed } from 'vue';


const props = defineProps({
    position: {
        type: Object,
        default: () => ({}),
    },
    departments: {
        type: Object,
        default: () => [],
    },
    readonly: {
        type: Boolean,
        default: false,
    }
});

const form = useForm("Create", {
    id: props.position.id ?? 0,
    name: props.position.name ?? '',
    department_id: props.position.department_id ?? '',
    level: props.position.level ?? '',
    description: props.position.description ?? '',
});

const submit = () => {
    if (form.id === 0) {
        form.post(route("job-positions.store"), {
            onSuccess: () => {
                form.reset()
                delete form.id
            }
        });
    }
    else {
        form.put(route("job-positions.update", props.position.id));
    }
};

const buttonLabel = computed(() => {
    return form.id === 0 ? 'create' : 'update'
})


</script>

<template>
    <div class="flex h-screen bg-slate-200">
        <div class="m-4 w-full h-56 bg-white flex items-center rounded-md">
            <form @submit.prevent="submit" class="w-full">
                <div class="grid grid-cols-2">
                    <div class="mx-9 text-sm font-medium flex items-center ">
                        <label class="w-36">Job Position </label>
                        <input id="name" v-model="form.name" type="text" :disabled="readonly"
                            class="border-0 h-7 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500 font-thin text-sm"
                            required>
                    </div>
                    <div class="mx-9 text-sm font-medium flex items-center ">
                        <label class="w-36">Department </label>
                        <select type="text" id="departments" v-model="form.department_id" :disabled="readonly"
                            class="border-0 h-10 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500 text-sm font-thin font-s">
                            <option disabled selected class="text-sm">Select Department</option>
                            <option v-for="department in departments" v-bind:value="department.id">
                                {{ department.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="mx-9 text-sm font-medium flex items-center ">
                    <label class="w-36">Level </label>
                    <input id="level" v-model="form.level" type="text" :disabled="readonly"
                        class="border-0 h-7 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500 text-sm font-thin">
                </div>

                <div class="mx-9 text-sm font-medium flex items-center ">
                    <label class="w-32">Summary </label>
                    <input id="description" v-model="form.description" type="text" :disabled="readonly"
                        class="border-0  w-3/4 hover:border-b-[1px] focus:ring-0 focus:border-slate-500 text-sm font-thin">

                </div>
                <div class="flex justify-end mt-10">
                    <PrimaryButton class="bg-[#7a61ab] text-white px-3 py-2 rounded-lg absolute right-20"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing" v-if="!readonly">
                        {{ buttonLabel }}
                    </PrimaryButton>
                    <div>
                        <Link :href="route('job-positions.index')"
                            class="bg-[#7a61ab] hover:bg-[#5f4d95] text-white px-3 py-2 rounded-lg absolute right-20"
                            v-if="readonly">
                        Back
                        </Link>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<!-- 
<script setup>
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    position: {
        type: Object,
        default: () => ({}),
    },
    allDepartments: {
        type: Object,
        default: () => [],
    },
    readonly: {
        type: Boolean,
        default: false,
    }
});

const form = useForm("Create", {
    id: props.position.id ?? 0,
    name: props.position.name ?? '',
    department_id: props.position.department_id ?? '',
    level: props.position.level ?? '',
    summary: props.position.summary ?? '',
});

const submit = () => {
    if (form.id === 0) {
        delete form.id
        form.post(route("job-positions.store"), {
            onSuccess: () => form.reset(),
        });
    }
    else {
        form.put(route("job-positions.update", props.position.id))
    }
};

const buttonLabel = computed(() => {
    return form.id === 0 ? 'create' : 'update'
})
</script>

<template>
    <div class="flex h-screen bg-violet-300">
        <div class="m-4 w-full h-56 bg-white flex items-center rounded-md">
            <form @submit.prevent="submit" class="w-full">
                <div class="grid grid-cols-2">
                    <div class="mx-9 text-sm font-medium flex items-center ">
                        <label class="w-36">Job Position </label>
                        <input id="name" v-model="form.name" type="text" :disabled="readonly"
                            class="border-0 h-7 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500 font-thin text-sm"
                            required>
                    </div>
                    <div class="mx-9 text-sm font-medium flex items-center ">
                        <label class="w-36">Department </label>
                        <select type="text" id="departments" v-model="form.department_id" :disabled="readonly"
                            class="border-0 h-10 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500 text-sm font-thin font-s">
                            <option disabled selected class="text-sm">Select Department</option>
                            <option v-for="oneDepartment in allDepartments" v-bind:value="oneDepartment.id">
                                {{ oneDepartment.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="mx-9 text-sm font-medium flex items-center ">
                    <label class="w-36">Level </label>
                    <input id="level" v-model="form.level" type="text" :disabled="readonly"
                        class="border-0 h-7 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500 text-sm font-thin">
                </div>

                <div class="mx-9 text-sm font-medium flex items-center ">
                    <label class="w-32">Summary </label>
                    <input id="summary" v-model="form.summary" type="text" :disabled="readonly"
                        class="border-0  w-3/4 hover:border-b-[1px] focus:ring-0 focus:border-slate-500 text-sm font-thin">
                </div>
                <div>
                    <div class="flex justify-end">
                        <button v-if="!readonly" class="bg-[#7a61ab] text-white px-3 py-2 rounded-lg absolute right-20"
                            :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            {{ buttonLabel }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template> -->