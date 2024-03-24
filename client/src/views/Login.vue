<script setup>
import { ref } from 'vue'
import axios from '../axios'
import { useRouter } from 'vue-router'
import AuthForm from '../components/AuthForm.vue'

const errorMessage = ref('')
const router = useRouter()

const handleLogin = (email) => {
    axios.post('/api/login', {
      email: email.value,
    }).then(response => {
      localStorage.setItem('userEmail', response.data.email);
      localStorage.setItem('authToken', response.data.token);

      console.log('Login successful:', response);
      router.push('/vote');
    }).catch(error => {
      console.error('Login error:', error);

      if (error.response.status === 404) {
        errorMessage.value = error.response.data.message;
        return;
      }

      errorMessage.value = 'Error during Login. Please try again.';
    })
}
</script>

<template>
  <AuthForm
    formTitle="Login"
    submitButtonText="Login"
    linkText="Register instead"
    linkRoute="/register"
    :onSubmit="handleLogin"
    :errorMessage="errorMessage"
  />
</template>

<style scoped>
</style>
