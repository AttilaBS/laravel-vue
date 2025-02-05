<script setup>
import { computed, ref, watch } from "vue";
import { Link, usePage, router } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";

// Getting the auth information
const page = usePage();
const user = computed(() => page.props.auth?.user ?? null);
const props = defineProps({
  auth: Object,
  products: Object
});

let search = ref('');

watch(search,  value => {
  router.get('/', { search: value}, {
    preserveState: true,
    replace: true
  });
});

if (!props.auth.user) {
  Inertia.visit('/user/create');
}

const createProduct = () => {
  Inertia.visit('/product/create');
};

const editProduct = (productId) => {
  Inertia.visit(`/product/edit/${productId}`);
};

const deleteProduct = (productId) => {
  if (confirm('Are you sure you want to delete this product?')) {
    Inertia.delete(`/product/delete/${productId}`);
  }
};
</script>

<template>
    <!-- Navigation -->
    <nav class="bg-white shadow p-4 flex justify-between">
      <h1 class="text-xl font-bold">Laravel Vue / Inertia App</h1>
      <div v-if="user">
        <div v-if="page">
          <a href="/dashboard" class="text-blue-600 hover:underline">Dashboard</a>
        </div>
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

    <!-- Create Product Button -->
    <section class="flex justify-between mb-6">
      <button @click="createProduct" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
        Create Product
      </button>
      <!--   Search   -->
        <input v-model="search" type="text" placeholder="Search..." class="border px-2 rounded-lg">
    </section>

    <div class="grid mb-8 border border-gray-200 rounded-lg shadow-xs dark:border-gray-700 md:mb-12 md:grid-cols-2 bg-white dark:bg-gray-800">
      <div v-for="product in products.data" :key="product.id" class="shadow-md text-center">
        <figure class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 rounded-t-lg md:rounded-t-none md:rounded-ss-lg md:border-e dark:bg-gray-800 dark:border-gray-700 min-h-100">
          <blockquote class="max-w-2xl mx-auto mb-4 text-gray-500 lg:mb-8 dark:text-gray-400">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Name:{{ product.name }}</h3>
            <p class="my-4">Description:{{ product.description }}</p>
          </blockquote>
          <figcaption class="flex items-center justify-center ">
            <div class="space-y-0.5 font-medium dark:text-white text-left rtl:text-right ms-3">
              <div>Price:{{ product.price }}</div>
              <div class="text-sm text-gray-500 dark:text-gray-400 ">Stock: {{ product.stock_quantity }}</div>
              <div class="text-sm text-gray-500 dark:text-gray-400 ">Created at: {{ product.created_at }}</div>
            </div>
          </figcaption>
          <!-- Buttons -->
          <div class="flex justify-center gap-2 mt-8">
            <button @click="editProduct(product.id)" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
              Edit
            </button>
            <button @click="deleteProduct(product.id)" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
              Delete
            </button>
          </div>
        </figure>
      </div>
    </div>
<!-- Paginator -->
  <div class="mt-6 mb-6">
    <template v-for="link in products.links">
      <Link
          v-if="link.url"
          :href="link.url"
          v-html="link.label"
          class="px-1"
          :class="{ 'text-gray-500' : ! link.url, 'font-bold' : link.active }"
      />
      <span v-else v-html="link.label" class="text-gray-400"></span>
    </template>
  </div>
</template>
