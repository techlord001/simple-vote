<script setup>
import { ref } from 'vue'
import axios from '../axios'
import { routeLocationKey } from 'vue-router';

const question = 'What is your favorite programming language?'
const choices = [
  { id: 1, name: 'C#' },
  { id: 2, name: 'JavaScript' },
  { id: 3, name: 'PHP' },
  { id: 4, name: 'Python' }
]

const selectedChoice = ref('')
const voteSubmitted = ref(false)
const voteMessage = ref('')

const submitVote = () => {
  const userEmail = localStorage.getItem('userEmail')
  const authToken = localStorage.getItem('authToken')

  if (!authToken || !userEmail) {
    console.error('Authentication details not found. Please login.')
    route.push('/login')
    return
  }

  axios.post('/api/vote', {
    email: userEmail,
    vote_number: selectedChoice.value,
    estimated_location: 'London'
  }, {
    headers: {
      Authorization: `Bearer ${authToken}`
    }
  }).then(response => {
    console.log('Vote successful:', response)
    voteMessage.value = response.data.message
    voteSubmitted.value = true
  }).catch(error => {
    console.error('Vote error:', error)

    if (error.response.status === 403 && error.response.data.message == 'You have already voted') {
      voteMessage.value = error.response.data.message
      voteSubmitted.value = true
      return
    }
  })

  localStorage.removeItem('userEmail')
  localStorage.removeItem('authToken')
}
</script>

<template>
  <div v-if="!voteSubmitted" class="flex flex-col items-center justify-center min-h-screen">
    <div class="p-8 border-2 border-border rounded-lg bg-secondary-background">
      <h1 class="text-3xl font-bold underline mb-4 text-secondary-text">
        {{ question }}
      </h1>
      <form @submit.prevent="submitVote" class="flex flex-col space-y-4">
        <div v-for="(choice, index) in choices" :key="index" class="flex items-center">
          <input type="radio" :id="choice.name" v-model="selectedChoice" :value="choice.id" class="mr-2" />
          <label :for="choice" class="text-secondary-text">{{ choice }}</label>
        </div>
        <button type="submit" class="bg-primary-background text-primary-text px-4 py-2 rounded hover:bg-primary-700 mt-4">
          Submit Vote
        </button>
      </form>
    </div>
  </div>
  <div v-else class="flex flex-col items-center justify-center min-h-screen">
    <div class="p-8 border-2 border-border rounded-lg bg-secondary-background">
      <h1 class="text-3xl font-bold mb-4 text-secondary-text">
        {{ voteMessage }}
      </h1>
    </div>
  </div>
</template>

<style scoped>
</style>
