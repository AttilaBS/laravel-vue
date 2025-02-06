<script setup>
import { useForm } from '@inertiajs/vue3';
import FlashMessage from "../../Components/FlashMessage.vue";
import BaseLayout from "../../Layout/BaseLayout.vue";

const form = useForm({
  name: null,
  price: null,
  description: null,
  stock_quantity: null
});

const submit = () => {
  form.post('/product/store', form);
};
</script>

<template>
  <BaseLayout />
  <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
    <FlashMessage />
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
      <h2 class="text-2xl font-bold mb-6 text-center">Create a Product</h2>
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block text-gray-700">Product Name</label>
          <input v-model="form.name" type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required />
          <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs mt-1"></div>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Price</label>
          <input v-model="form.price" type="number" step="0.01" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required />
          <div v-if="form.errors.price" v-text="form.errors.price" class="text-red-500 text-xs mt-1"></div>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Description</label>
          <textarea v-model="form.description" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
          <div v-if="form.errors.description" v-text="form.errors.description" class="text-red-500 text-xs mt-1"></div>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Stock Quantity</label>
          <input v-model="form.stock_quantity" type="number" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></input>
          <div v-if="form.errors.stock_quantity" v-text="form.errors.stock_quantity" class="text-red-500 text-xs mt-1"></div>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600" :disabled="form.processing">Create Product</button>
      </form>
    </div>
  </div>
</template>
