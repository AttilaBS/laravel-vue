<script setup>
import { useForm } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";

const form = useForm({
  email: "",
  password: "",
});

const props = defineProps({
    auth: Object,
  });

if (props.auth.user) {
  Inertia.visit('/');
}

const submit = () => {
  form.post("/user/login");
};
</script>

<template>
  <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow">
    <!-- Flash Success Message -->
    <div v-if="$page.props.flash && $page.props.flash.success" class="bg-green-200">
      {{ $page.props.flash.success }}
    </div>
    <div v-if="$page.props.flash && $page.props.flash.error" class="bg-red-200">
      {{ $page.props.flash.error }}
    </div>
    <div v-if="$page.props.errors && Object.keys($page.props.errors).length" class="text-red-700 font-bold">
      <ul>
        <li v-for="(errorMessages, field) in $page.props.errors" :key="field">
          {{ errorMessages }}
        </li>
      </ul>
    </div>
    <h2 class="text-2xl font-bold text-center mb-4">Login</h2>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block text-sm font-medium">Email</label>
        <input v-model="form.email" type="email" class="w-full p-2 border rounded" required />
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium">Password</label>
        <input v-model="form.password" type="password" class="w-full p-2 border rounded" required />
      </div>

      <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Login</button>
    </form>
  </div>
</template>
