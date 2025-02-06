<script setup>
import { ref, watch } from "vue";
import { Link, router } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { debounce } from '@/helpers/debounce';
import FlashMessage from "../Components/FlashMessage.vue";
import BaseLayout from "../Layout/BaseLayout.vue";

const props = defineProps({
  products: Object,
  can: Object
});

const fetchResults = debounce(() => {
  router.get('/', { search: search.value }, { preserveState: true });
}, 300);

let search = ref('');

watch(search,  () => {
  fetchResults();
});

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
  <BaseLayout />
  <!-- Hero Section -->
  <section class="text-center py-20 bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-md">
    <FlashMessage />
    <h1 class="text-5xl font-bold mb-3">Discover Amazing Products</h1>
    <p class="text-lg text-gray-200">Find the best deals on our catalog.</p>
  </section>

  <!-- Controls Section -->
  <section class="flex justify-between items-center mt-10 mb-6 px-6">
    <button
        @click="createProduct"
        class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition-shadow shadow-md"
    >
      + Create Product
    </button>

    <input
        v-model="search"
        type="text"
        placeholder="Search for products..."
        class="w-1/3 border border-gray-300 px-4 py-2 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
    />
  </section>

  <!-- Product Grid -->
  <div class="grid mb-8 px-6 gap-6 md:grid-cols-3 lg:grid-cols-4">
    <div
        v-for="product in products.data"
        :key="product.id"
        class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all"
    >
      <figure class="p-6 text-center">
        <blockquote>
          <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-600 mb-2">{{ product.name }}</h3>
          <p class="text-sm text-gray-600 mb-4">{{ product.description }}</p>
        </blockquote>

        <figcaption class="text-left">
          <p class="font-semibold text-gray-700">Price: <span class="text-blue-600">${{ product.price }}</span></p>
          <p class="text-sm text-gray-500">Stock: {{ product.stock_quantity }}</p>
          <p class="text-sm text-gray-400">Added: {{ product.created_at }}</p>
        </figcaption>

        <!-- Buttons -->
        <div class="flex justify-center gap-3 mt-6">
          <button
              v-if="can.editProduct"
              @click="editProduct(product.id)"
              class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition"
          >
            Edit
          </button>
          <button
              v-if="can.destroyProduct"
              @click="deleteProduct(product.id)"
              class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition"
          >
            Delete
          </button>
        </div>
      </figure>
    </div>
  </div>

  <!-- Paginator -->
  <div class="flex justify-center space-x-2 mt-6 mb-6">
    <template v-for="link in products.links" :key="link.label">
      <Link
          v-if="link.url"
          :href="link.url"
          v-html="link.label"
          class="px-3 py-2 rounded-md border text-gray-700 bg-white hover:bg-gray-100 transition"
          :class="{ 'font-bold bg-blue-500 text-black' : link.active }"
      />
      <span v-else v-html="link.label" class="text-gray-400 px-3 py-2"></span>
    </template>
  </div>
</template>
