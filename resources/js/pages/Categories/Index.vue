<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { type Category } from '@/types/categories';
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'

interface PaginatedData<T> {
  data: T[];
  links: { url: string | null; label: string; active: boolean }[];
  current_page: number;
}

const props = defineProps<{
  categories: PaginatedData<Category[]>;
  filters: {
    search: string | null;
  };
}>();

const search = ref(props.filters.search || '');

watch(search, (value) => {
  router.get(
    route('categories.index'), // Use Laravel's route helper if available
    { search: value },
    { preserveState: true, replace: true }
  );
}, { debounce: 300 }); // Optional: debounce for performance

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Categories',
    href: '/categories',
  },
];

function handleDelete(id: number) {
  if (confirm('Are you sure you want to delete this category?')) {
    router.delete(route('categories.destroy', id), {
      preserveState: true,
      onSuccess: () => {
        console.log('Category deleted successfully');
      },
      onError: (errors) => {
        console.error('Error deleting category:', errors);
      },
    });
  }
}

</script>

<template>

  <Head title="Categories" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div>

      <!-- Create button and search bar here -->
      <div class="flex justify-between items-center p-1">
        <Link href="/categories/create">
        <Button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Create Category
        </Button>
        </Link>
        <input type="text" v-model="search" placeholder="Search Categories"
          class="border border-gray-300 p-2 rounded-md mr-5 w-[400px]">
      </div>
      <!-- End create button and search bar here -->

      <!-- Table to display categories -->
      <Table>
        <TableCaption>A list of your recent categories.</TableCaption>
        <TableHeader>
          <TableRow>
            <TableHead class="w-[100px]">
              ID
            </TableHead>
            <TableHead>Name</TableHead>
            <TableHead>Description</TableHead>
            <TableHead class="text-center">
              Actions
            </TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow v-for="category in props.categories.data" :key="category.id">
            <TableCell class="font-medium">
              {{ category.id }}
            </TableCell>
            <TableCell>{{ category.name }}</TableCell>
            <TableCell>{{ category.description }}</TableCell>
            <TableCell class="text-center">
              <Link :href="route('categories.show', category.id)">
              <Button class="btn mr-2 bg-green-500 hover:bg-green-700">Show</Button>
              </Link>
              <Button @click="handleDelete(category.id)" class="btn bg-red-500 hover:bg-red-700">Delete</Button>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>


      <!-- Pagination: -->
      <nav class="flex justify-center mt-2" aria-label="Page navigation example">
        <ul class="inline-flex -space-x-px text-sm">
          <li v-for="link in props.categories.links" :key="link.label" :disabled="!link.url">
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