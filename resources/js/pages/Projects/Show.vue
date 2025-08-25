<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { type Project } from '@/types/projects';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Projects',
        href: '/projects/',
    },
];

const props = defineProps<{
    project: Project;
}>();

</script>

<template>
    <Head title="Projects" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div>
            <h1 class="text-2xl font-bold">{{ props.project.name }}</h1>
            <p class="mt-2">{{ props.project.descriptor }}</p>
        </div>
    </AppLayout>
</template>
