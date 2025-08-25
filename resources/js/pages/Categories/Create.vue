<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';

interface FormItem {
    name: string;
    description: string;
}

const form = useForm({
    items: [] as FormItem[],
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Categories',
        href: '/categories/create',
    },
];

function addRow() {
    form.items.push({ name: '', description: '' });

}

function removeItem(index: number) {
    form.items.splice(index, 1);
}


function submitForm() {

    form.post(route('categories.store'));
    // form.reset('items');
}


</script>

<template>

    <Head title="Create Categories" />

    <AppLayout :breadcrumbs="breadcrumbs">


        <form @submit.prevent="submitForm">
            <div class="flex space-x-8 mb-1" v-for="(item, index) in form.items" :key="index">

                <label class="block text-sm font-medium text-gray-700">Name</label>
                <Input
                :class="[{ 'error-border': form.errors[`items.${index}.name`] }]"
                type="text" v-model="item.name" placeholder="Category Name" />
                <div class="text-sm text-red-600" v-if="form.errors[`items.${index}.name`]"></div>

                <label class="block text-sm font-medium text-gray-700">Description</label>
                <Input
                :class="[{ 'error-border': form.errors[`items.${index}.description`] }]"
                type="text" v-model="item.description" placeholder="Category Description" />
                <div class="text-sm text-red-600" v-if="form.errors[`items.${index}.description`]"></div>

                <Button type="button" @click="removeItem(index)">Remove</Button>
            </div>
            <Button class="mt-3 mr-3" type="button" @click="addRow">Add Item</Button>
            <Button>Submit Form</Button>
        </form>


    </AppLayout>
</template>


<style>
.error-border {
    border: 1px solid red;
    /* You can customize the error border style as needed */
  /* background-color: rgb(241, 199, 234); */
}

</style>