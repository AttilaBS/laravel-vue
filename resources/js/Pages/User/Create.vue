<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const form = reactive({
  name: null,
  email: null,
  password: null,
  password_confirmation: null
})

function submit() {
  router.post('/user/create', form)
}
</script>

<template>
  <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
    <!-- Validation Errors -->
    <div v-if="$page.props.errors && Object.keys($page.props.errors).length" class="text-red-700 font-bold">
      <ul>
        <li v-for="(errorMessages, field) in $page.props.errors" :key="field">
          {{ errorMessages }}
        </li>
      </ul>
    </div>
    <div v-if="$page.props.flash && $page.props.flash.error" class="bg-red-200">
      {{ $page.props.flash.error }}
    </div>
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
      <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block text-gray-700">Name</label>
          <input v-model="form.name" type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Email</label>
          <input v-model="form.email" type="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Password</label>
          <input v-model="form.password" type="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Password Confirmation</label>
          <input v-model="form.password_confirmation" type="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required />
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Register</button>
      </form>
    </div>
    <div class="mt-4">
      <inertia-link href="/user/login" class="text-blue-500 hover:underline">Already have an account? Login</inertia-link>
    </div>
  </div>
</template>
