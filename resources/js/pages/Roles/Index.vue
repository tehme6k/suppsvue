<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import {can} from '@/lib/can';

interface Role{
    id: number,
    name: string
}

interface PaginatedData<T> {
    data: T[];
    links: { url: string | null; label: string; active: boolean }[];
    current_page: number;
}

const props = defineProps<{
    roles: PaginatedData<Role[]>;
    filters: {
        search: string | null;
    };
}>();

const search = ref(props.filters.search || '');

watch(search, (value) => {
    router.get(
        route('roles.index'), // Use Laravel's route helper if available
        { search: value },
        { preserveState: true, replace: true }
    );
}, { debounce: 300 }); // Optional: debounce for performance

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Roles',
        href: '/roles',
    },
];

function handleDelete(id: number) {
    if (confirm('Are you sure you want to delete this role?')) {
        router.delete(route('roles.destroy', id), {
            preserveState: true,
            onSuccess: () => {
                console.log('Role deleted successfully');
            },
            onError: (errors) => {
                console.error('Error deleting role:', errors);
            },
        });
    }
}

</script>

<template>

    <Head title="Roles" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div>

            <!-- Create button and search bar here -->
            <div class="flex justify-between items-center p-1">
                <div>
                    <Link v-if="can('all') || can('role.create')" :href="route('roles.create')"
                        class="mb-4 px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Create
                    </Link>
                </div>
                <input type="text" v-model="search" placeholder="Search Roles"
                    class="border border-gray-300 p-2 rounded-md mr-5 w-[400px]">
            </div>
            <!-- End create button and search bar here -->

            <!-- Table to display roles -->
            <div class="p-3">
                <h1 class="text-2xl font-bold mb-4">Roles</h1>

                <div class="overflow-x-auto mt-4">
                    <table class="w-full text-sm text-left text-gray-700">
                        <thead class="text-xs uppercase bg-gray-50 text-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Permissions</th>

                                <th scope="col" class="px-6 py-3 w-70">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="role in props.roles.data" :key="role.id" class="odd:bg-white even:bg-gray-50 border-b border-gray-200">
                                <td class="px-6 py-2 font-medium text-gray-900">{{ role.id }}</td>
                                <td class="px-6 py-2 text-gray-700">{{ role.name }}</td>
                                <td class="px-6 py-2 text-gray-700">
                                    <span
                                    v-for="permission in role.permissions"
                                        key="1"
                                        class="mr-1 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300"
                                    >
                                        {{ permission.name }}
                                    </span>
                                </td>
                                <td class="px-6 py-2 space-x-1">
                                    <Link v-if="can('all') || can('role.edit')" :href="route('roles.edit', role.id)"
                                        class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                        Edit
                                    </Link>
                                    <Link :href="route('roles.show', role.id)"
                                        class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                                        Show
                                    </Link>
                                    <button v-if="can('all') || can('role.delete')" @click="handleDelete(role.id)"
                                        class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                                        Delete
                                </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end table to display users here  -->


            <!-- Pagination: -->
            <nav class="flex justify-center mt-2" aria-label="Page navigation example">
                <ul class="inline-flex -space-x-px text-sm">
                    <li v-for="link in props.roles.links" :key="link.label" :disabled="!link.url">
                        <a :active="link.active" v-if="link.url" :href="link.url" v-html="link.label"
                            :class="['flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white', { 'active-class': link.active }]"></a>
                        <span v-else v-html="link.label"
                            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"></span>
                    </li>
                </ul>
            </nav>
            <!-- End table to display categories here -->





        </div>
    </AppLayout>
</template>

<style>
.active-class {
    background-color: lightblue;
}
</style>