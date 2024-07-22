import { defineStore } from 'pinia'
import ApiService from '@/core/service/ApiService'
import { ref } from 'vue'


export const useTaskStore = defineStore('tasks',()=>{
  const taskAssigned = ref([])
  const  errors = ref({})
  function  setErrors(error:any){
    errors.value={...error}
  }
  function getTaskAssigned(){
    return ApiService.get('task_user')
      .then(({data})=>{
        console.log(data)
        taskAssigned.value= data.tasks;
      })
      .catch(({error})=>{
        setErrors(error)
      })
  }
  return{
    errors,
    getTaskAssigned,
    taskAssigned,
  }
})