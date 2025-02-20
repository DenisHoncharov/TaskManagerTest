import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from "@/views/LoginView.vue";
import RegisterView from "@/views/Register.vue";
import TaskList from "@/views/Task/TaskList.vue";
import CreateTask from "@/views/Task/CreateTask.vue";
import ShowTask from "@/views/Task/ShowTask.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
    },
    {
      path: '/registration',
      name: 'registration',
      component: RegisterView,
    },


    {
      path: '/tasks',
      name: 'tasksList',
      component: TaskList,
    },
    {
      path: '/task/create',
      name: 'createTask',
      component: CreateTask,
    },
    {
      path: '/task/:id',
      name: 'showTask',
      component: ShowTask
    },
  ],
})

export default router
