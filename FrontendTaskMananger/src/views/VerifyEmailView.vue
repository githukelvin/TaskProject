<template>
  <div class="min-h-screen bg-gray-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Verify Your Email
      </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <div class="text-center">
          <p class="text-sm text-gray-700 mb-4">
            We've sent a verification link to your email address. Please check your inbox and click the link to verify your account.
          </p>
          <check-circle-icon class="mx-auto h-12 w-12 text-green-500 mb-4" />
          <p class="text-sm text-gray-700 mb-6">
            If you don't see the email, please check your spam folder.
          </p>
          <button
            @click="verifyEmail"
            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            I've verified my email
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { CheckCircleIcon } from 'lucide-vue-next'

const verifyEmail = (): void => {
  // Handle email verification logic here
  console.log('Email verified')
  // Typically, you would check if the email is actually verified
  // and then redirect the user to the appropriate page
}
</script>