<template>
  <button @click="toggleTheme" class="p-2 rounded bg-gray-200 dark:bg-gray-700">
    <span v-if="theme === 'dark'" class="text-gray-800 dark:text-gray-200">☀️ Light</span>
    <span v-else class="text-gray-800 dark:text-gray-200">🌙 Dark</span>
  </button>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';

const theme = ref('light');

onMounted(() => {
  theme.value = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
});

watch(theme, (val) => {
  if (val === 'dark') {
    document.documentElement.classList.add('dark');
  } else {
    document.documentElement.classList.remove('dark');
  }
  localStorage.setItem('theme', val);
});

function toggleTheme() {
  theme.value = theme.value === 'light' ? 'dark' : 'light';
}
</script>
