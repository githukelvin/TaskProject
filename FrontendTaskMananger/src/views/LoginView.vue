<template>
  <div class="min-h-screen bg-gray-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Sign in to your account
      </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form class="space-y-6" @submit.prevent="handleSubmit">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
              Email address
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <mail-icon class="h-5 w-5 text-gray-400" />
              </div>
              <input
                id="email"
                name="email"
                type="email"
                autocomplete="email"
                required
                class="focus:ring-indigo-500 py-3 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md"
                placeholder="you@example.com"
                v-model="email"
              />
            </div>
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
              Password
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <lock-icon class="h-5 w-5 text-gray-400" />
              </div>
              <input
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                required
                class="focus:ring-indigo-500 focus:border-indigo-500 block py-3 w-full pl-10 sm:text-sm border-gray-300 rounded-md"
                placeholder="••••••••"
                v-model="password"
              />
            </div>
          </div>


          <div>
            <button
              type="submit"
              class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              Sign in
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { MailIcon, LockIcon } from 'lucide-vue-next'
import { useAuthStore, type User } from '@/stores/auth'
import { useRouter } from 'vue-router'

    const email = ref<string>('')
    const password = ref<string>('')
    const store = useAuthStore()
const router = useRouter()
    const handleSubmit = async (values): void => {
      // Handle login logic here
      const credentials =  {
        email: email.value,
        password: password.value,
      }
      values= credentials as User
      await store.login(values)
      const error = Object.values(store.errors)

      if(error.length === 0){
        store.errors={}
        router.push({name:'user'})

      }else{
        alert(error as string)
      }
      console.log('Login attempt',)
    }




</script>