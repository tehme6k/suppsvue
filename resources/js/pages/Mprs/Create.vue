<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import Multiselect from 'vue-multiselect'
import 'vue-select/dist/vue-select.css'; // Import styles
import { Button } from '@/components/ui/button';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';


interface FormItem {
    project_id: number;
}

interface Project {
    id: number;
    name: string;
    full_project_name: string;
}
const props = defineProps<{
    projects: Project[];

}>();

// const props = defineProps<{
//     projects: Array<{ id: number; name: string ; full_project_name: string; descriptor: string; servings: number;}>;
//     filters: { search: string | null };
// }>();

// const selectedProject = ref(null);
// const searchTerm = ref(props.filters.search || '');

// watch(searchTerm, (newValue) => {
//     router.get(route('mprs.create'), { search: newValue }, { preserveState: true, replace: true });
// });

const form = useForm({
    items: [] as FormItem[],
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Mprs',
        href: '/mprs/create',
    },
];

function addRow() {
    form.items.push({ project_id: 0 });

}

function removeItem(index: number) {
    form.items.splice(index, 1);
}


function submitForm() {

    console.log(form.items);
    form.post(route('mprs.store'));
    // form.reset('items');
}













</script>

<template>

    <Head title="Create Mprs" />

    <AppLayout :breadcrumbs="breadcrumbs">





        <form @submit.prevent="submitForm">
            <div class="flex space-x-8 mb-1 mt-1 ml-2" v-for="(item, index) in form.items" :key="index">
                <Select v-model="item.project_id" class="w-full">
                    <SelectTrigger :class="[{ 'error-border': form.errors[`items.${index}.project_id`] }]">
                        <SelectValue placeholder="Select Project" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup v-for="value in props.projects" :key="value.id">
                            <SelectItem :value="Number(value.id)">
                                {{ value.full_project_name }}
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