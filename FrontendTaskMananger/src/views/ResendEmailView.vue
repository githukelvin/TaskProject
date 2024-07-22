<template>
  <div class="min-h-screen bg-gray-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Resend Verification Email
      </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form class="space-y-6" @submit.prevent="resendEmail">

          <div>
            <button
              type="submit"
              class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              :disabled="isLoading"
            >
              {{ isLoading ? 'Sending...' : 'Resend Verification Email' }}
            </button>
          </div>
        </form>

        <div v-if="message" class="mt-4 text-sm text-center" :class="messageClass">
          {{ message }}
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import { useAuthStore } from '@/stores/auth'

const email = ref<string>('')
const isLoading = ref<boolean>(false)
const message = ref<string>('')
const messageType = ref<'success' | 'error'>('success')

const messageClass = computed(() => ({
  'text-green-600': messageType.value === 'success',
  'text-red-600': messageType.value === 'error'
}))

const store = useAuthStore()

const resendEmail = async (): Promise<void> => {
  isLoading.value = true
  message.value = ''



  try {
    // Simulating an API call
    await new Promise(resolve => setTimeout(resolve, 1500))

    // Handle resend verification email logic here
    await  store.resendEmail()

    console.log('Resend verification email to:', email.value)

    messageType.value = 'success'
    message.value = 'Verification email sent successfully. Please check your inbox.'
  } catch (error) {
    messageType.value = 'error'
    message.value = 'Failed to send verification email. Please try again.'
  } finally {
    isLoading.value = false
  }
}
</script>