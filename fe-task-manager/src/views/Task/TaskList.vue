<script setup>
import { onBeforeMount, ref } from 'vue';
import axios from 'axios';

const tasksMain = ref([]);

function getUserTasks() {
  axios.get('/tasks')
      .then(response => {
        tasksMain.value = response.data.tasks || [];
      })
      .catch(error => {
        console.error(error);
      });
}

function removeTask(id) {
  axios.delete(`/tasks/${id}`)
      .then(() => {
        tasksMain.value = tasksMain.value.filter(task => task.id !== id);
      })
      .catch(error => {
        console.error(error);
      });
}

onBeforeMount(() => {
  getUserTasks();
});
</script>

<template>
  <div>
    <a href="/task/create">Create New Task</a>
    <ul>
      <li v-for="item in tasksMain" :key="item.id">
        <a :href="'/task/' + item.id">{{ item.title }}</a>
        <form @submit.prevent="removeTask(item.id)" class="removeTask">
          <div class="form-group">
            <button type="submit" class="form-input">X</button>
          </div>
        </form>
      </li>
    </ul>
  </div>
</template>

<style scoped>

</style>

<style scoped>

</style>