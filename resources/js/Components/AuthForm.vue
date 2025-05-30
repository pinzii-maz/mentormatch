<!-- resources/js/Components/AuthForm.vue -->
<template>
  <form @submit.prevent="submit" class="flex flex-col gap-3">
    <div>
      <input v-model="form.email" type="email" placeholder="Email" class="w-full p-2 border rounded mb-1 bg-gray-900 text-white border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      <div v-if="form.errors.email" class="text-red-400 text-xs">{{ form.errors.email }}</div>
    </div>
    <div>
      <input v-model="form.password" type="password" placeholder="Password" class="w-full p-2 border rounded mb-1 bg-gray-900 text-white border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      <div v-if="form.errors.password" class="text-red-400 text-xs">{{ form.errors.password }}</div>
    </div>
    <div class="flex justify-between items-center">
      <label class="flex items-center gap-2 text-sm">
        <input v-model="form.remember" type="checkbox" /> Remember me
      </label>
      <a href="/forgot-password" class="text-blue-400 hover:underline text-sm">Forgot your password?</a>
    </div>
    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-bold mt-2" :disabled="form.processing">
      Sign in
    </button>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
const form = useForm({
  email: '',
  password: '',
  remember: false,
});

function submit() {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  });
}
</script>
