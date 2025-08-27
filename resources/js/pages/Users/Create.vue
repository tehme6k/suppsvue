<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import Password from '../settings/Password.vue';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create User',
        href: '/users/create',
    },
];

defineProps({
    'roles': Array
})

const form = useForm({
    name: '',
    email: '',
    password: '',
    roles: []


});


</script>

<template>

    <Head title="Create User" />

    <AppLayout :breadcrumbs="breadcrumbs">

        <div class="overflow-x-auto p-3">
            <Link :href="route('users.index')"
                class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg">
            Back to Users
            </Link>

            <form @submit.prevent="form.post(route('users.store'))" class="space-y-6 mt-4 max-w-md mx-auto">

                <div class="grid gap-2">
                    <label for="name"
                        class="text-sm leading-none font-medium select-none peer-disabled:cursor-not-allowed peer-disabled:opacity-50">
                        Name:
                    </label>
                    <input id="name" name="name" v-model="form.name"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-base shadow-sm transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter your name" />
                    <p v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</p>
                </div>

                <div class="grid gap-2">
                    <label for="email"
                        class="text-sm leading-none font-medium select-none peer-disabled:cursor-not-allowed peer-disabled:opacity-50">
                        Email:
                    </label>
                    <input id="email" name="email" v-model="form.email" type="email"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-base shadow-sm transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter your email" />
                    <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</p>
                </div>

                <div class="grid gap-2">
                    <label for="password"
                        class="text-sm leading-none font-medium select-none peer-disabled:cursor-not-allowed peer-disabled:opacity-50">
                        Password:
                    </label>
                    <input id="password" name="password" v-model="form.password" type="password"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-base shadow-sm transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter your password" />
                    <p v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</p>
                </div>

                <div class="grid gap-2">
                    <!-- {{ form.roles }} -->
                    <label for="roles"
                        class="text-sm leading-none font-medium select-none peer-disabled:cursor-not-allowed peer-disabled:opacity-50">
                        Roles:
                    </label>
                    <label v-for="role in roles" key="1" class="flex items-center space-x-2">
                        <input :value="role" v-model="form.roles" type="checkbox"
                            class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-2 focus:ring-blue-500" />
                        <span class="text-gray-800 capitalize">{{ role }}</span>
                    </label>
                    <p v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</p>
                </div>



                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition">
                    Submit
                </button>

            </form>

        </div>




    </AppLayout>
</template>

<style>
.active-class {
    background-color: lightblue;
}
</style>