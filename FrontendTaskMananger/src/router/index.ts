import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import { useAuthStore } from '@/stores/auth'

const router = createRouter({
  linkActiveClass: ' rounded-xl bg-[#EEEEEE]',
  linkExactActiveClass: ' rounded-xl bg-[#EEEEEE]',
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path:'/',
      children:[
        {
          path: '/login',
          name: 'login',
          component: LoginView
        },
        {
          path: '/register',
          name: 'register',
          component:RegisterView
        },
        {
          path: '/verify_email',
          name: 'verify_email',
          component:()=>import('@/views/VerifyEmailView.vue'),
          meta:{
            middleware: 'auth'
          }
        },
        {
          path: '/resend_email',
          name: 'resend_email',
          component:()=>import('@/views/ResendEmailView.vue'),
          meta:{
            middleware: 'auth'
          }
        },


      ]

    },
    {
      path:'/',
      component:()=>import('@/layouts/AuthenticaticatedLayout.vue'),
      children:[
        {
          path: '/user',
          name: 'user',
          component:()=>import('@/views/user/index.vue'),
          meta:{
            middleware: 'auth'
          }
        }
      ]
    }
  ]
})

router.beforeEach((to,from,next)=>{
  const store = useAuthStore()

  if(to.meta.middleware =='auth'){
    store.verifyAuth()
    if(store.isAuthenticated){
      next()
    }else{
      next({name: 'login'})
    }
  }
  else {
    next()
  }
  window.scrollTo({
    top: 0,
    left: 0,
    behavior: 'smooth'
  })
})



export default router
