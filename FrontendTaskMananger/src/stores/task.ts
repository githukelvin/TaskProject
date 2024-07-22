import { defineStore } from 'pinia'
import ApiService from '@/core/service/ApiService'
import { ref } from 'vue'
import axios from 'axios'

export interface Team {
  id: number;
  team_name: string;
  description: string;
  user_id: number;
  team_members: TeamMembers;
  created_at: string;
  updated_at: string;
}

export interface TeamMembers {
  user_ids: number[];
  team_lead: number;
}

export interface Assignee {
  id: number;
  name: string;
  email: string;
  is_admin: number;
  email_verified_at: string | null;
  created_at: string;
  updated_at: string;
}

export interface Task {
  id: number;
  assignee_id: number;
  creator: number;
  team_id: number | null;
  title: string;
  description: string;
  estimated_effort: string;
  priority: string;
  labels: string;
  due_date: string;
  status: string;
  created_at: string;
  updated_at: string;
  user_id: number | null;
  assigned: Assignee;
  team: Team;
}


export const useTaskStore = defineStore('tasks',()=>{
  const taskAssigned = ref([])
  const  errors = ref({})
  const task = ref<Task>({} as Task);

  function  setErrors(error:any){
    errors.value={...error}
  }
  function getTaskAssigned(){
    return ApiService.get('task_user')
      .then(({data})=>{
        // console.log(data)
        taskAssigned.value= data.tasks;
      })
      .catch(({error})=>{
        setErrors(error)
      })
  }
  function taskView(id:number){
    return ApiService.get('tasks',id)
      .then(({data})=>{
        task.value = data.task;
        console.log(data)
      })
      .catch(({error})=>{
        setErrors(error)
      })
  }
  function updateTaskStatus(id:number,status:any){
    return axios.post(`tasks${id}`, { data:status })
      .then(({data})=>{
        task.value = data.task;
        console.log(data)
      })
      .catch(({error})=>{
        setErrors(error)
      })
  }
  return{
    errors,
    getTaskAssigned,
    taskAssigned,
    taskView,
    task,
    updateTaskStatus
  }
})