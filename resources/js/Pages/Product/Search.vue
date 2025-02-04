<script setup>
import BaseLayout from '../../Layout/BaseLayout.vue'
import { Head } from '@inertiajs/vue3'

defineProps({ products: Object })
</script>

<template>
  <Layout>
    <Head title="Welcome" />
    <h1>Welcome</h1>
    <p>Products:  {{ products }} </p>
  </Layout>
</template>
