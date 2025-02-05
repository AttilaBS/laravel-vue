<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import {Inertia} from "@inertiajs/inertia";

const form = useForm({
  name: null,
  email: null,
  password: null,
  password_confirmation: null
})

const props = defineProps({
  auth: Object,
});

if (props.auth?.user) {
  Inertia.visit('/');
}

function submit() {
  form.post('/user/create')
}
</script>

<template>
  <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
    <!-- Validation Errors -->
    <div v-if="form.flash && form.flash.error" class="bg-red-200">
      {{ form.flash.error }}
    </div>
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
      <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block text-gray-700">Name</label>
          <input v-model="form.name" type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required />
          <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs mt-1"></div>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Email</label>
          <input v-model="form.email" type="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required />
          <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-xs mt-1"></div>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Password</label>
          <input v-model="form.password" type="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required />
          <div v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 text-xs mt-1"></div>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Password Confirmation</label>
          <input v-model="form.password_confirmation" type="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required />
          <div v-if="form.errors.password_confirmation" v-text="form.errors.password_confirmation" class="text-red-500 text-xs mt-1"></div>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600" :disabled="form.processing">Register</button>
      </form>
    </div>
    <div class="mt-4">
      <Link href="/user/login" class="text-blue-500 hover:underline">Already have an account? Login</Link>
    </div>
  </div>
</template>
