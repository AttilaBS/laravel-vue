<template>
  <div class="flex justify-center">
    <div v-if="flash.success" class="bg-green-200 w-100 text-center">
      {{ flash.success }}
    </div>
    <div v-if="flash.error" class="bg-red-200">
      {{ flash.error }}
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const flash = computed(() => page.props.flash || {});
</script>
