<script setup lang="ts">

import TaskSelectorComponent from '@/components/TaskSelectorComponent.vue'
import { useTaskStore } from '@/stores/task'
const store = useTaskStore();
const handleStatusChange =async (newStatus: string) => {
  // task.value.status = newStatus;
  // Here you would typically make an API call to update the task status
  const status = {
    "status": newStatus
  }
  let taskID= store.task.id
  await  store.updateTaskStatus(taskID,status)
  console.log(`Task status updated to: ${newStatus}`,taskID);
};
</script>

<template>
<div>
  <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Task Title: {{store.task.title}}</h1>
    <p class="text-gray-700 mb-2"><span class="font-semibold">Task Description:</span> {{store.task.description}}</p>
    <p class="text-gray-700"><span class="font-semibold">Assigned To:</span> {{store.task.assigned.name}}</p>
    <TaskSelectorComponent
      :initial-status="store.task.status"
      @status-change="handleStatusChange"
    />
  </div>



</div>
</template>

<style scoped>

</style>