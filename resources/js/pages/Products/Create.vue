<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

interface FormItem {
    name: string;
    description: string;
    category_id: number;
}

interface Category {
    id: number;
    name: string;
}
const props = defineProps<{
    source: Category[];
}>();

const form = useForm({
    items: [] as FormItem[],
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Products',
        href: '/products/create',
    },
];

function addRow() {
    form.items.push({ name: '', description: '', category_id: 0 });

}

function removeItem(index: number) {
    form.items.splice(index, 1);
}


function submitForm() {

    console.log(form.items);
    form.post(route('products.store'));
    // form.reset('items');
}


</script>

<template>

    <Head title="Create Categories" />

    <AppLayout :breadcrumbs="breadcrumbs">


        <form @submit.prevent="submitForm">
            <div class="flex space-x-8 mb-1 mt-1 ml-2" v-for="(item, index) in form.items" :key="index">

                <!-- <div v-for="(error, key) in form.errors" >
                    <div class="text-sm text-red-600">{{ error }}</div>
                </div> -->

                
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <Input
                :class="[{ 'error-border': form.errors[`items.${index}.name`] }]"
                type="text" v-model="item.name" placeholder="Product Name" />
              

                <label class="block text-sm font-medium text-gray-700">Description</label>
                <Input
                :class="[{ 'error-border': form.errors[`items.${index}.description`] }]"
                type="text" v-model="item.description" placeholder="Product Description" />
                

                <Select v-model="item.category_id" class="w-full">
                    <SelectTrigger :class="[{ 'error-border': form.errors[`items.${index}.category_id`] }]">
                        <SelectValue placeholder="Select Category" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup v-for="value in source" :key="value.id">
                            <SelectItem :value="Number(value.id)">
                                {{ value.name }}
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>



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