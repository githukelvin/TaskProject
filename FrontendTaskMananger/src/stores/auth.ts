import { defineStore } from 'pinia'
import JWTService from '@/core/service/JWTService'
import ApiService from '@/core/service/ApiService'
import { useRouter } from 'vue-router'
import axios from 'axios'
import { ref } from 'vue'

export interface User {
  name:string,
  email:string,
  password:string,
  token:string
}

export  const useAuthStore = defineStore('auth',()=>{
  const  errors = ref({})
  const user = ref<User>({} as User)
  const isAuthenticated = ref(!!JWTService.getToken())
  const router = useRouter();

  const EMAIL_ROUTES = {
    SEND_VERIFICATION: 'email/send-verification',
    RESEND: 'email/resend',
  };

  const REDIRECT_ROUTES = {
    VERIFY_EMAIL: '/verify_email',
    RESEND_EMAIL: '/resend_email',
  };


  function setAuth(authUser:any){
    isAuthenticated.value = true
    user.value= authUser.user
    errors.value ={}
    JWTService.saveToken(authUser.token)
  }

  function  setErrors(error:any){
    errors.value={...error}
  }
  function purgeAuth() {
    isAuthenticated.value = false
    JwtService.destroyToken()
    user.value = {} as User
    errors.value = {}
  }
  function register(credential:User){
    return ApiService.post('register',credential)
      .then(({data})=>{
      })
      .catch(({error})=>{
        setErrors(error)
      })
  }

  function login ( credentials:User){
    return ApiService.post('login',credentials)
      .then(({data})=>{
        setAuth(data)
      })
      .catch(({error})=>{
        setErrors(error)
      })


  }

  async function handleEmailAction(actionType) {
    try {
      const { data } = await ApiService.post(EMAIL_ROUTES[actionType]);

      if (data.success) {
         router.push(REDIRECT_ROUTES.VERIFY_EMAIL);
      }
    } catch (error) {
      setErrors(error);

      if (actionType === 'SEND_VERIFICATION') {
         router.push(REDIRECT_ROUTES.RESEND_EMAIL);
      }
    }
  }

  // async  function emailVerification(values:string){
  //   return ApiService.query('/email/verify',values).then(
  //      {data }
  //   )
  // }

  async function verifyAuth() {
    if (JWTService.getToken()) {
      ApiService.setHeader()
      try {
        const { data } = await axios.get('/verify-token', {
          headers: {
            Authorization: `Bearer ${JWTService.getToken()}`
          }
        })
        // console.log(data)
        setAuth(data)
      } catch (error) {
        router.push({ name: 'login' })
        setError(error)
        purgeAuth()
      }
    } else {
      purgeAuth()
    }
  }
   const sendEmail = () => handleEmailAction('SEND_VERIFICATION');
   const resendEmail = () => handleEmailAction('RESEND')

  return {
    login,
    user,
    register,
    errors,
    verifyAuth,
    isAuthenticated,
    sendEmail,
    resendEmail

  }
})