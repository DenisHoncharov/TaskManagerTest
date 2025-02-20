<script setup>
import {onBeforeRouteUpdate, useRoute, useRouter} from 'vue-router';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const route = useRoute();
const router = useRouter();
const task = ref({});
const message = ref();
const availableStatuses = [
  'Pending',
  'In Progress',
  'Done'
];

async function getTaskDetails(id) {
  try {
    const response = await axios.get(`/tasks/${id}`);
    task.value = response.data.task || {};
  } catch (error) {
    console.error(error);
  }
}

function editTask(id) {
  message.value = '';
  axios.put(`tasks/${id}`, task.value)
      .then(response => {
        router.push({ name: 'tasksList' });
      })
      .catch(error => {
        console.log(error)
        if (error.response.status === 422) {
          message.value = error.response.data.message;
        }
      })
}

onMounted(() => {
  getTaskDetails(route.params.id);
});

onBeforeRouteUpdate(async (to) => {
  await getTaskDetails(to.params.id);
});
</script>

<template>
  <div>
    <p v-if="message" class="error">{{ message }}</p>
    <form @submit.prevent="editTask(task.id)" class="editTask">
      <div class="form-group">
        <label>Title</label>
        <input v-model="task.title" type="text" class="form-input">
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea v-model="task.description" class="form-input"></textarea>
      </div>
      <div class="form-group">
        <label>Status</label>
        <select v-model="task.status">
          <option disabled>Select Task Status</option>
          <option v-for="option in availableStatuses" :value="option">
            {{ option }}
          </option>
        </select>
      </div>
      <div class="form-group">
        <button type="submit" class="form-input">Edit Task</button>
      </div>
    </form>
  </div>
</template>


<style scoped>
.form-group {
  display: flex;
  flex-direction: column;
}
.form-input {
  padding: 0.5em;
  font-size: 1em;
}
.error {
  color: red;
  font-size: 1em;
}
</style>