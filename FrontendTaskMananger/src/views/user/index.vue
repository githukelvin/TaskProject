<template>
<div>
  <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
    <div class="flex flex-wrap justify-between gap-3 p-4"><p class="text-black tracking-light text-[32px] font-bold leading-tight min-w-72">Dashboard</p></div>
    <h3 class="text-black text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Overview</h3>
    <div class="grid grid-cols-4 gap-3 p-4">
      <div class="flex flex-1 gap-3 rounded-lg border border-[#DEDEDE] bg-[#FFFFFF] p-4 items-center">
        <div class="text-black" data-icon="Clock" data-size="24px" data-weight="regular">
          <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
            <path
              d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"
            ></path>
          </svg>
        </div>
        <h2 class="text-black text-base font-bold leading-tight">Pending tasks</h2>
      </div>
      <div class="flex flex-1 gap-3 rounded-lg border border-[#DEDEDE] bg-[#FFFFFF] p-4 items-center">
        <div class="text-black" data-icon="User" data-size="24px" data-weight="regular">
          <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
            <path
              d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"
            ></path>
          </svg>
        </div>
        <h2 class="text-black text-base font-bold leading-tight">Active users</h2>
      </div>
      <div class="flex flex-1 gap-3 rounded-lg border border-[#DEDEDE] bg-[#FFFFFF] p-4 items-center">
        <div class="text-black" data-icon="CheckCircle" data-size="24px" data-weight="regular">
          <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
            <path
              d="M173.66,98.34a8,8,0,0,1,0,11.32l-56,56a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L112,148.69l50.34-50.35A8,8,0,0,1,173.66,98.34ZM232,128A104,104,0,1,1,128,24,104.11,104.11,0,0,1,232,128Zm-16,0a88,88,0,1,0-88,88A88.1,88.1,0,0,0,216,128Z"
            ></path>
          </svg>
        </div>
        <h2 class="text-black text-base font-bold leading-tight">Completed tasks</h2>
      </div>
      <div class="flex flex-1 gap-3 rounded-lg border border-[#DEDEDE] bg-[#FFFFFF] p-4 items-center">
        <div class="text-black" data-icon="XCircle" data-size="24px" data-weight="regular">
          <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
            <path
              d="M165.66,101.66,139.31,128l26.35,26.34a8,8,0,0,1-11.32,11.32L128,139.31l-26.34,26.35a8,8,0,0,1-11.32-11.32L116.69,128,90.34,101.66a8,8,0,0,1,11.32-11.32L128,116.69l26.34-26.35a8,8,0,0,1,11.32,11.32ZM232,128A104,104,0,1,1,128,24,104.11,104.11,0,0,1,232,128Zm-16,0a88,88,0,1,0-88,88A88.1,88.1,0,0,0,216,128Z"
            ></path>
          </svg>
        </div>
        <h2 class="text-black text-base font-bold leading-tight">Cancelled tasks</h2>
      </div>
    </div>
    <h3 class="text-black text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">My Tasks</h3>
    <div class="px-4 py-3 @container">
      <div v-if="tasks.length >=1">
        No Tasks Yet
      </div>

      <div v-else class="flex overflow-hidden rounded-xl border border-[#DEDEDE] bg-[#FFFFFF]">
        <table class="flex-1">
          <thead>
          <tr class="bg-[#FFFFFF]">
            <th class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-120 px-4 py-3 text-left text-black w-[400px] text-sm font-medium leading-normal">Task ID</th>
            <th class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-240 px-4 py-3 text-left text-black w-[400px] text-sm font-medium leading-normal">Task</th>
            <th class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-480 px-4 py-3 text-left text-black w-[400px] text-sm font-medium leading-normal">Due date</th>
            <th class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-600 px-4 py-3 text-left text-black w-60 text-sm font-medium leading-normal">Status</th>
            <th class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-720 px-4 py-3 text-left text-black w-60 text-[#6B6B6B] text-sm font-medium leading-normal"></th>
          </tr>
          </thead>
          <tbody>
          <tr class="border-t border-t-[#DEDEDE]">
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-120 h-[72px] px-4 py-2 w-[400px] text-[#6B6B6B] text-sm font-normal leading-normal">#123</td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-240 h-[72px] px-4 py-2 w-[400px] text-black text-sm font-normal leading-normal">
              Design a new landing page
            </td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-480 h-[72px] px-4 py-2 w-[400px] text-[#6B6B6B] text-sm font-normal leading-normal">Sep 30</td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-600 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
              <button
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#EEEEEE] text-black text-sm font-medium leading-normal w-full"
              >
                <span class="truncate">In progress</span>
              </button>
            </td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-720 h-[72px] px-4 py-2 w-60 text-[#6B6B6B] text-sm font-bold leading-normal tracking-[0.015em]">
              View
            </td>
          </tr>
          <tr class="border-t border-t-[#DEDEDE]">
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-120 h-[72px] px-4 py-2 w-[400px] text-[#6B6B6B] text-sm font-normal leading-normal">#124</td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-240 h-[72px] px-4 py-2 w-[400px] text-black text-sm font-normal leading-normal">
              Add payment methods
            </td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-480 h-[72px] px-4 py-2 w-[400px] text-[#6B6B6B] text-sm font-normal leading-normal">Oct 10</td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-600 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
              <button
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#EEEEEE] text-black text-sm font-medium leading-normal w-full"
              >
                <span class="truncate">In progress</span>
              </button>
            </td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-720 h-[72px] px-4 py-2 w-60 text-[#6B6B6B] text-sm font-bold leading-normal tracking-[0.015em]">
              View
            </td>
          </tr>
          <tr class="border-t border-t-[#DEDEDE]">
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-120 h-[72px] px-4 py-2 w-[400px] text-[#6B6B6B] text-sm font-normal leading-normal">#125</td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-240 h-[72px] px-4 py-2 w-[400px] text-black text-sm font-normal leading-normal">
              Optimize website speed
            </td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-480 h-[72px] px-4 py-2 w-[400px] text-[#6B6B6B] text-sm font-normal leading-normal">Oct 5</td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-600 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
              <button
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#EEEEEE] text-black text-sm font-medium leading-normal w-full"
              >
                <span class="truncate">To do</span>
              </button>
            </td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-720 h-[72px] px-4 py-2 w-60 text-[#6B6B6B] text-sm font-bold leading-normal tracking-[0.015em]">
              View
            </td>
          </tr>
          <tr class="border-t border-t-[#DEDEDE]">
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-120 h-[72px] px-4 py-2 w-[400px] text-[#6B6B6B] text-sm font-normal leading-normal">#126</td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-240 h-[72px] px-4 py-2 w-[400px] text-black text-sm font-normal leading-normal">
              Implement security features
            </td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-480 h-[72px] px-4 py-2 w-[400px] text-[#6B6B6B] text-sm font-normal leading-normal">Oct 15</td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-600 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
              <button
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#EEEEEE] text-black text-sm font-medium leading-normal w-full"
              >
                <span class="truncate">To do</span>
              </button>
            </td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-720 h-[72px] px-4 py-2 w-60 text-[#6B6B6B] text-sm font-bold leading-normal tracking-[0.015em]">
              View
            </td>
          </tr>
          <tr class="border-t border-t-[#DEDEDE]">
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-120 h-[72px] px-4 py-2 w-[400px] text-[#6B6B6B] text-sm font-normal leading-normal">#127</td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-240 h-[72px] px-4 py-2 w-[400px] text-black text-sm font-normal leading-normal">
              Fix login issues
            </td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-480 h-[72px] px-4 py-2 w-[400px] text-[#6B6B6B] text-sm font-normal leading-normal">Oct 1</td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-600 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
              <button
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#EEEEEE] text-black text-sm font-medium leading-normal w-full"
              >
                <span class="truncate">Done</span>
              </button>
            </td>
            <td class="table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-720 h-[72px] px-4 py-2 w-60 text-[#6B6B6B] text-sm font-bold leading-normal tracking-[0.015em]">
              View
            </td>
          </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>

</div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue'
import { useTaskStore } from '@/stores/task'
const store = useTaskStore()

const  tasks = store.taskAssigned
console.log(tasks)

onMounted(()=>{
  const store = useTaskStore()

   store.getTaskAssigned()


})

</script>

<style scoped>
@container(max-width:120px){.table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-120{display: none;}}
@container(max-width:240px){.table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-240{display: none;}}
@container(max-width:360px){.table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-360{display: none;}}
@container(max-width:480px){.table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-480{display: none;}}
@container(max-width:600px){.table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-600{display: none;}}
@container(max-width:720px){.table-051acd33-0814-453b-ae83-5b1d1048d6b4-column-720{display: none;}}
</style>