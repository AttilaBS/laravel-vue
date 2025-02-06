<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import FlashMessage from "../../Components/FlashMessage.vue";
import BaseLayout from "../../Layout/BaseLayout.vue";

const form = useForm({
  email: "",
  password: "",
});

const { props } = usePage();

const submit = () => {
  form.post("/user/login");
};
</script>

<template>
  <BaseLayout />
  <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
    <FlashMessage />
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
      <h2 class="text-2xl font-bold text-center mb-4">Login</h2>
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block text-sm font-medium">Email</label>
          <input v-model="form.email" type="email" class="w-full p-2 border rounded" required />
          <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-xs mt-1"></div>
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium">Password</label>
          <input v-model="form.password" type="password" class="w-full p-2 border rounded" required />
          <div v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 text-xs mt-1"></div>
        </div>

        <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Login</button>
      </form>
    </div>
  </div>
</template>
