<script setup>
import { ref } from 'vue'
import axios from '../axios'
import { useRouter } from 'vue-router'
import AuthForm from '../components/AuthForm.vue'

const errorMessage = ref('')
const router = useRouter()

const handleRegister = (email) => {
    axios.post('/api/register', {
      email: email.value,
    }).then(response => {
      console.log('Registration successful:', response);
      router.push('/vote');
    }).catch(error => {
      console.error('Registration error:', error);
      if (error.response.status === 409) {
        errorMessage.value = error.response.data.message;
        return;
      }
      errorMessage.value = 'Error during registration. Please try again.';
    })
}
</script>

<template>
  <AuthForm
    formTitle="Register"
    submitButtonText="Register"
    linkText="Login instead"
    linkRoute="/login"
    :onSubmit="handleRegister"
    :errorMessage="errorMessage"
  />
</template>
