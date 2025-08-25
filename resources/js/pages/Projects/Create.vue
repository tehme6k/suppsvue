<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';

interface FormItem {
    name: string;
    descriptor: string;
    servings: number;
}

const form = useForm({
    items: [] as FormItem[],
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Projects',
        href: '/projects/create',
    },
];

function addRow() {
    form.items.push({ name: '', descriptor: '', servings: 0 });

}

function removeItem(index: number) {
    form.items.splice(index, 1);
}


function submitForm() {

    form.post(route('projects.store'));
    // form.reset('items');
}


</script>

<template>

    <Head title="Create Projects" />

    <AppLayout :breadcrumbs="breadcrumbs">


        <form @submit.prevent="submitForm">
            <div class="flex space-x-8 mb-1 mt-1 ml-2" v-for="(item, index) in form.items" :key="index">

                <label class="block text-sm font-medium text-gray-700">Name</label>
                <Input :class="[{ 'error-border': form.errors[`items.${index}.name`] }]" type="text" v-model="item.name"
                    placeholder="Project Name" />
               

                <label class="block text-sm font-medium text-gray-700">Descriptor</label>
                <Input
                :class="[{ 'error-border': form.errors[`items.${index}.descriptor`] }]"
                type="text" v-model="item.descriptor" placeholder="Project Descriptor" />

                <label class="block text-sm font-medium text-gray-700">Servings</label>
                <Input
                :class="[{ 'error-border': form.errors[`items.${index}.servings`] }]"
                type="number" v-model="item.servings" placeholder="Number of Servings" />
              

                <Button type="button" @click="removeItem(index)">Remove</Button>
            </div>
            <Button class="ml-2 mt-3 mr-3" type="button" @click="addRow">Add Item</Button>
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