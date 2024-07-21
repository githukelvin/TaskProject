import JWTService from '@/core/service/JWTService';
import type { App} from 'vue'
import {  type AxiosResponse } from 'axios'
import axios from 'axios'
import VueAxios from 'vue-axios'


class ApiService {
//   propery to share  vue instance
  public static vueInstance:App

  // initialize vue axios

  public static init(app:App<Element>){
    ApiService.vueInstance=app
    ApiService.vueInstance.use(VueAxios,axios)
    ApiService.vueInstance.axios.defaults.baseURL= import.meta.env.VITE_APP_API_URL
    ApiService.vueInstance.axios.defaults.headers.common.Accept='*'

  }

//   set http request headers
  public static setHeader(){
    ApiService.vueInstance.axios.defaults.headers.common.Authorization  = `Bearer ${JWTService.getToken()}`
    ApiService.vueInstance.axios.defaults.headers.common.Accept='application/json'
    ApiService.vueInstance.axios.defaults.headers.common['Content-Type']='application/json'
  }

//   GET HTTP request
  public  static  query(resource:string,params:any):Promise<AxiosResponse>{
    return ApiService.vueInstance.axios.get(resource,params)
  }

//   GET HTTP slug param
  public  static  get(resource:string,slug = '' as String):Promise<AxiosResponse>{
    return ApiService.vueInstance.axios.get(`${resource}/${slug}`)
  }

//   POST  resource  with params
  public static  post(resource:string,params:any):Promise<AxiosResponse>{
    return ApiService.vueInstance.axios.post(`${resource}`,params)
  }

// /   update  resource  with params
  public static  update(resource:string,slug:string,params:any):Promise<AxiosResponse>{
    return ApiService.vueInstance.axios.post(`${resource}/${slug}`,params)
  }

  /**
   * @description Send the PUT HTTP request
   * @returns Promise<AxiosResponse>
   * @param resource
   * @param params
   */
  public static put(resource: string, params: any): Promise<AxiosResponse> {
    return ApiService.vueInstance.axios.put(`${resource}`, params)
  }

  /**
   * @description Send the DELETE HTTP request
   * @returns Promise<AxiosResponse>
   * @param resource
   */
  public static delete(resource: string): Promise<AxiosResponse> {
    return ApiService.vueInstance.axios.delete(resource)
  }

}

export default ApiService