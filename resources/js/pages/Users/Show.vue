<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';





const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Show User',
        href: '/users/',
    },
];

const props = defineProps({
    user: Object,
    userRoles: Array
})




</script>

<template>

    <Head title="Show User" />

    <AppLayout :breadcrumbs="breadcrumbs">

        <div class="overflow-x-auto p-3">
            <Link :href="route('users.index')"
                class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg">
            Back to Users
            </Link>

            <div class="mt-2">
                <p><strong>Name: </strong> {{ props.user.name }}</p>
                <p><strong>Email: </strong> {{ props.user.email }}</p>
                <p><strong>Roles: </strong>
                    <span v-for="role in userRoles" key="1"
                        class="mr-1 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                        {{ role }}
                    </span>
                </p>
            </div>


        </div>
    </AppLayout>
</template>

<style>
.active-class {
    background-color: lightblue;
}
</style>