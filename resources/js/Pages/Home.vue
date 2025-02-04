<script setup>
import { computed, watch } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();
const user = computed(() => page.props.auth?.user ?? null);
const isLoaded = computed(() => page.props.auth !== undefined);

// Redirect if no user is authenticated
watch(
    [user, isLoaded],
    ([newUser, loaded]) => {
      if (loaded && !newUser) {
        window.location.href = "/user/login";
      }
    },
    300
);

// Sample product data (replace with real data from backend)
const products = [
  { id: 1, name: "Product A", price: "$19.99", image: "https://placehold.co/150" },
  { id: 2, name: "Product B", price: "$29.99", image: "https://placehold.co/150" },
  { id: 3, name: "Product C", price: "$39.99", image: "https://placehold.co/150" },
];
</script>

<template>
  <div class="min-h-screen bg-gray-100 text-gray-900">
    <!-- Navigation -->
    <nav class="bg-white shadow p-4 flex justify-between">
      <h1 class="text-xl font-bold">Product Catalog</h1>
      <div v-if="user">
        <a href="/dashboard" class="text-blue-600 hover:underline">Dashboard</a>
      </div>
      <div v-else>
        <a href="/user/login" class="text-blue-600 mr-4 hover:underline">Login</a>
        <a href="/user/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Sign Up</a>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="text-center py-16">
      <h1 class="text-4xl font-bold mb-2">Discover Amazing Products</h1>
      <p class="text-lg text-gray-600">Find the best deals on our catalog.</p>
    </section>

    <!-- Product Showcase -->
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-6 py-8">
      <div v-for="product in products" :key="product.id" class="bg-white p-4 rounded-lg shadow-md text-center">
        <img :src="product.image" alt="Product Image" class="w-full h-40 object-cover rounded-md mb-3">
        <h2 class="text-lg font-semibold">{{ product.name }}</h2>
        <p class="text-blue-600 font-bold">{{ product.price }}</p>
        <button class="mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
          View Product
        </button>
      </div>
    </section>
  </div>
</template>
