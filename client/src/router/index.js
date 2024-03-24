import { createRouter, createWebHistory } from 'vue-router'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Verify from '../views/Verify.vue'
import Vote from '../views/Vote.vue'

const routes = [
    {
      path: '/login',
      name: 'Login',
      component: Login,
    },
    {
      path: '/register',
      name: 'Register',
      component: Register,
    },
    {
      path: '/verify',
      name: 'Verify',
      component: Verify,
    },
    {
      path: '/vote',
      name: 'Vote',
      component: Vote,
    },]

const router = createRouter({
    history: createWebHistory(),
    routes,
  })

export default router