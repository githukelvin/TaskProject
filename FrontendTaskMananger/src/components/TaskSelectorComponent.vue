<script setup lang="ts">
import { ref, watch } from 'vue';

interface Props {
  initialStatus: string;
}

const props = defineProps<Props>();
const emit = defineEmits(['statusChange']);

const status = ref(props.initialStatus);

const statuses = [
  { value: 'inPending', label: 'In Pending' },
  { value: 'inProgress', label: 'In Progress' },
  { value: 'completed', label: 'Completed' },
  { value: 'approved', label: 'Approved' },
  { value: 'declined', label: 'Declined' },
];

const getStatusColor = (statusValue: string): string => {
  switch (statusValue) {
    case 'inpending':
      return 'bg-yellow-100 text-yellow-800';
    case 'inprogress':
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

watch(status, (newStatus) => {
  emit('statusChange', newStatus);
});
</script>

<template>
  <div class="relative inline-block w-full">
    <select
      v-model="status"
      class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
    >
      <option
        v-for="statusOption in statuses"
        :key="statusOption.value"
        :value="statusOption.value"
        :class="getStatusColor(statusOption.value)"
      >
        {{ statusOption.label }}
      </option>
    </select>
    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
      </svg>
    </div>
  </div>
  <p class="mt-2 text-sm" :class="getStatusColor(status)">
    Current Status: {{ statuses.find(s => s.value === status)?.label }}
  </p>
</template>