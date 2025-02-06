<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { useAuthStore } from "../store-auth";
import { watch, computed } from "vue";
import {Inertia} from "@inertiajs/inertia";

const authStore = useAuthStore();
const { props, component } = usePage();

const isLoginPage = computed(() => component === "User/Login");
const isSignupPage = computed(() => component === "User/Create");

watch(
    () => props.auth,
    (newAuth) => {
      if (newAuth?.user) {
        authStore.setUser(newAuth.user);
      } else {
        authStore.clearUser();
      }
    },
    { immediate: true }
);

const user = authStore.user;
const isAuthenticated = authStore.isAuthenticated;

function logout() {
  Inertia.post('/user/logout').then(() => {
    authStore.clearUser();
  });
}
</script>

<template>
  <nav class="bg-gray-300 shadow p-4">
    <div v-if="isAuthenticated" class="flex justify-between">
      <div>
        <h1 class="text-lg font-bold">Laravel Vue / Inertia App</h1>
        <p class="text-sm ml-4">Welcome Back, {{ user.name }}</p>
      </div>
      <div class="flex">
        <Link href="/" as="button" class="cursor-pointer">Home</Link>
        <button @click="logout" class="cursor-pointer ml-4">Logout</button>
      </div>
    </div>
    <div v-else>
      <Link
          v-if="!isLoginPage"
          href="/user/login"
          class="text-blue-600 mr-4 hover:underline">
        Login
      </Link>
      <Link
          v-if="!isSignupPage"
          href="/user/create"
          class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Sign Up
      </Link>
    </div>
  </nav>
</template>
