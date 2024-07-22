import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'

const router = createRouter({
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
          // route level code-splitting
          // this generates a separate chunk (About.[hash].js) for this route
          // which is lazy-loaded when the route is visited.
          component:RegisterView
        }
      ]
    }
  ]
})

export default router
