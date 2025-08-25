<script setup lang="ts">
import FlashMessage from '@/components/FlashMessage.vue';
import { Input } from '@/components/ui/input';
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

// const moo = ref('shoes');
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <FlashMessage />
        <slot />
    </AppLayout>
</template>
