<!-- resources/js/Pages/ActivityLog/Index.vue -->
<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
// import { type Activity } from '@/types/ActivityLog';
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';

interface Causer {
  id: number;
  name: string;
  // Add other user properties you need
}

interface Subject {
  id: number;
  name: string;
  // Add other user properties you need
}

interface Activity {
  id: number;
  log_name: string;
  description: string;
  subject_type: string;
  subject_id: number;
  causer_id: number | null;
  properties: Record<string, any>;
  created_at: string;
  causer: Causer | null;
  subject: Subject | null;
}

interface PaginationLink {
  url: string | null;
  label: string;
  active: boolean;
}

interface PaginatedData {
  data: Activity[];
  links: PaginationLink[];
  current_page: number;
  last_page: number;
  // ... other pagination metadata
}

const props = defineProps<{
  activities: PaginatedData;
  filters: {
    search: string | null;
  };
}>();


const search = ref(props.filters.search || '');

watch(search, (value) => {
  router.get(
    route('activities.index'), // Use Laravel's route helper if available
    { search: value },
    { preserveState: true, replace: true }
  );
}, { debounce: 300 }); // Optional: debounce for performance

// const props = defineProps<{
//   activities: App.Data.ActivitiesPage;
// }>();

const formatModelName = (subjectType: string | null): string => {
  if (!subjectType) return 'N/A';
  const parts = subjectType.split('\\');
  return parts[parts.length - 1];
};

</script>

<template>

  <Head title="Activity Log" />
  <AppLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Activity Log</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <input type="text" v-model="search" placeholder="Search Activity Logs"
          class="mb-3 border border-gray-300 p-2 rounded-md mr-5 w-[400px]">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <h3 class="text-lg font-medium text-gray-900">Recent Activities</h3>
            <div class="mt-6 border-t border-gray-200">
              <ul role="list" class="divide-y divide-gray-200">
                <li v-for="activity in props.activities.data" :key="activity.id" class="py-4">
                  <div class="flex space-x-3">
                    <div class="flex-1 space-y-1">
                      <div class="flex items-center justify-between">
                        <h3 class="text-sm font-medium">{{ activity.description }} - {{
                          formatModelName(activity.subject_type) }} </h3>
                        <p class="text-sm text-gray-500">{{ new Date(activity.created_at).toLocaleString() }}</p>
                      </div>
                      <p></p>
                      <p class="text-sm text-gray-500">
                        By: {{ activity.causer?.name || 'System' }}
                      </p>
                      <p v-if="activity.properties" class="text-sm text-gray-500">
                        <span class="font-semibold">Details:</span>
                        {{ activity.properties }}
                      </p>
                    </div>
                  </div>
                </li>
              </ul>
              <nav class="flex justify-center mt-2" aria-label="Page navigation example">
                <ul class="inline-flex -space-x-px text-sm">
                  <li v-for="link in props.activities.links" :key="link.label" :disabled="!link.url">
                    <a :active="link.active" v-if="link.url" :href="link.url" v-html="link.label"
                      :class="['flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white', { 'active-class': link.active }]"></a>
                    <span v-else v-html="link.label"
                      class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"></span>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style>
.active-class {
  background-color: lightblue;
}
</style>