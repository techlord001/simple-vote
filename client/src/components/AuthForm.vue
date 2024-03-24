<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const props = defineProps({
  formTitle: String,
  submitButtonText: String,
  linkText: String,
  linkRoute: String,
  onSubmit: Function,
  errorMessage: String,
});

const email = ref('');
const router = useRouter();

const handleSubmit = () => {
  props.onSubmit(email);
}
</script>

<template>
    <div class="flex flex-col items-center justify-center min-h-screen">
      <div class="p-8 border-2 border-border rounded-lg bg-secondary-background">
        <h1 class="text-3xl font-bold underline mb-4 text-secondary-text">{{ formTitle }}</h1>
        <form @submit.prevent="handleSubmit" class="flex flex-col space-y-4">
          <input v-model="email" type="email" placeholder="Email" class="px-4 py-2 rounded border-2 border-border focus:outline-none" required>
          <!-- Error Message -->
          <div v-if="errorMessage" class="text-red-500">{{ errorMessage }}</div>
          <div class="flex justify-between items-center">
            <RouterLink :to="linkRoute" class="inline-block bg-primary-background text-primary-text px-4 py-2 rounded hover:bg-primary-700 text-center mr-2">{{ linkText }}</RouterLink>
            <button type="submit" class="bg-primary-background text-primary-text px-4 py-2 rounded hover:bg-primary-700">{{ submitButtonText }}</button>
          </div>
        </form>
      </div>
    </div>
</template>
