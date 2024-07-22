<script setup lang="ts">
import {  onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import { useTaskStore } from '@/stores/task'


// onMounted(()=>{
//   const  store = useTaskStore()
//   const route = useRoute();
//   const taskId = route.params.id;
//   console.log(taskId)
//   store.viewtask(taskId)
// })
  const route = useRoute();


  const taskId = route.params.id;
  const  store = useTaskStore()
  console.log(taskId)
  store.taskView(taskId)





    const formatDate = (dateString: string): string => {
      return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });
    };

    const getPriorityColor = (priority: string): string => {
      switch (priority.toLowerCase()) {
        case 'high':
          return 'bg-red-100 text-red-800';
        case 'medium':
          return 'bg-yellow-100 text-yellow-800';
        case 'low':
          return 'bg-green-100 text-green-800';
        default:
          return 'bg-gray-100 text-gray-800';
      }
    };

const getStatusColor = (statusValue: string): string => {
  switch (statusValue) {
    case 'inPending':
      return 'bg-yellow-100 text-yellow-800';
    case 'inProgress':
      return 'bg-blue-100 text-blue-800';
    case 'completed':
      return 'bg-green-100 text-green-800';
    case 'approved':
      return 'bg-purple-100 text-purple-800';
    case 'declined':
      return 'bg-red-100 text-red-800';
    default:
      return 'bg-gray-100 text-gray-800';
  }
};



</script>

<template>
  <div class="max-w-4xl  p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ store.task.title }}</h1>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
      <div class="p-6 space-y-4">
        <div class="flex items-center justify-between">
          <span class="text-sm font-medium text-gray-500">Task ID: {{ store.task.id }}</span>
          <span :class="['px-2 py-1 rounded-full text-xs font-medium', getStatusColor(store.task.status)]">
            {{ store.task.status }}
          </span>
        </div>
        <p class="text-gray-700">{{ store.task.description }}</p>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <h2 class="text-sm font-medium text-gray-500">Assignee</h2>
            <p class="mt-1 text-sm text-gray-900">{{ store.task.assigned.name }}</p>
            <p class="mt-1 text-sm text-gray-500">{{ store.task.assigned.email }}</p>
          </div>
          <div>
            <h2 class="text-sm font-medium text-gray-500">Estimated Effort</h2>
            <p class="mt-1 text-sm text-gray-900">{{ store.task.estimated_effort }}</p>
          </div>
          <div>
            <h2 class="text-sm font-medium text-gray-500">Priority</h2>
            <span :class="['mt-1 inline-block px-2 py-1 text-xs font-medium rounded-full', getPriorityColor(store.task.priority)]">
              {{ store.task.priority }}
            </span>
          </div>
          <div>
            <h2 class="text-sm font-medium text-gray-500">Labels</h2>
            <p class="mt-1 text-sm text-gray-900">{{ store.task.labels }}</p>
          </div>
          <div>
            <h2 class="text-sm font-medium text-gray-500">Due Date</h2>
            <p class="mt-1 text-sm text-gray-900">{{ formatDate(store.task.due_date) }}</p>
          </div>

          <div class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-720 h-[72px] px-4 py-2 w-60 text-[#6B6B6B] text-sm font-bold leading-normal tracking-[0.015em]">
            <router-link :to="{ name: 'tasks.id.edit',params:{ id: store.task.id } }">Update Status</router-link>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-6 py-4">
        <div class="text-sm">
          <p class="text-gray-500">Created: {{ formatDate(store.task.created_at) }}</p>
          <p class="text-gray-500">Last Updated: {{ formatDate(store.task.updated_at) }}</p>
        </div>
      </div>
    </div>
  </div>
</template>