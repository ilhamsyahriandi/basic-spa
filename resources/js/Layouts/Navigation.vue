<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';


defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>

        <Head :title="title" />

        <div class="min-h-screen bg-gray-200">
            <nav class="bg-[#71629f]">
                <!-- Primary Navigation Menu -->
                <div class="">
                    <div class="
                        flex items-center 
                        justify-between 
                        h-10 ">
                        <div class="flex text-white">
                            <div class="
                            hover:bg-[#5a4e7e] 
                            focus:outline-none 
                            focus:bg-[#5a4e7e] 
                            active:bg-gray-50">
                                <Dropdown width="48">
                                    <template #trigger>
                                        <button type="button" class="flex">
                                            <ApplicationMark class="block h-10 w-auto" />
                                        </button>
                                    </template>
                                    <template #content>
                                        <DropdownLink :href="route('employees.index')">
                                            Employees
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>

                            <!-- <div class="flex items-center justify-center     hover:bg-[#5a4e7e]
                                            focus:outline-none 
                                            focus:bg-[#5a4e7e]
                                            active:bg-gray-50 ">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <button type="button" class="
                                     ">

                                        </button>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('employees.index')">
                                            Employees
                                        </DropdownLink>


                                        <div class="border-t border-gray-200" />

                                        <form @submit.prevent="logout">
                                            <DropdownLink as="button">
                                                Log Out
                                            </DropdownLink>
                                        </form>
                                    </template>
                                </Dropdown>
                            </div> -->
                            <!-- Navigation Links -->
                            <!-- <div class=" sm:-my-px sm:flex text-white hover:bg-[#5f4d95]">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')"
                                    class="text-white">
                                    Dashboard
                                </NavLink>
                            </div> -->
                            <div class=" sm:-my-px sm:flex text-white hover:bg-[#5f4d95]">
                                <NavLink :href="route('employees.index')" :active="route().current('employees.index')"
                                    class="text-white">
                                    Employees
                                </NavLink>
                            </div>
                            <div class=" sm:-my-px sm:flex text-white hover:bg-[#5f4d95]">
                                <NavLink :href="route('departments.index')" :active="route().current('departments.index')"
                                    class="text-white">
                                    Departments
                                </NavLink>
                            </div>
                            <div class=" sm:-my-px sm:flex text-white hover:bg-[#5f4d95]">
                                <NavLink :href="route('job-positions.index')"
                                    :active="route().current('job-positions.index')" class="text-white">
                                    Job Position
                                </NavLink>
                            </div>
                        </div>
                    </div>
                </div>

            </nav>

            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-full py-2 px-4 ">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>