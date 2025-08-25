<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { type Category } from '@/types/categories';
import { categories } from '@vueuse/core/metadata.cjs';
import { Input } from '@/components/ui/input';
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import { Button } from '@/components/ui/button';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Categories',
        href: '/categories/',
    },
];

const props = defineProps<{
    category: Category;
}>();

</script>

<template>
    <Head title="Categories" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div>
            <h1 class="text-2xl font-bold">{{ props.category.name }}</h1>
            <p class="mt-2">{{ props.category.description }}</p>
        </div>
    </AppLayout>
</template>
