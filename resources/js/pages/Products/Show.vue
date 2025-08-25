<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { type Product } from '@/types/products';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Products',
        href: '/products/',
    },
];

const props = defineProps<{
    product: Product;
}>();

</script>

<template>
    <Head title="Products" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div>
            <h1 class="text-2xl font-bold">{{ props.product.name }}</h1>
            <p class="mt-2">{{ props.product.description }}</p>
            <p class="mt-2 font-semibold">Category: {{ props.product.category.name }}</p>
        </div>
    </AppLayout>
</template>
