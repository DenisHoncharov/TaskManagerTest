<script setup>
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
const router = useRouter();
const form = reactive({
  title: '',
  description: '',
  status: '',
});
const message = ref();
const availableStatuses = [
  'Pending',
  'In Progress',
  'Done'  
];

function createTask() {
  message.value = '';
  axios.post('tasks', form)
      .then(response => {
        router.push({ name: 'tasksList' });
      })
      .catch(error => {
        if (error.response.status === 422) {
          message.value = error.response.data.message;
        }
      })
}
</script>

<template>
  <div>
    <p v-if="message" class="error">{{ message }}</p>
    <form @submit.prevent="createTask" class="createTask">
      <div class="form-group">
        <label>Title</label>
        <input v-model="form.title" type="text" class="form-input">
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea v-model="form.description" class="form-input"></textarea>
      </div>
      <div class="form-group">
        <label>Status</label>
        <select v-model="form.status">
          <option disabled>Select Task Status</option>
          <option v-for="option in availableStatuses" :value="option">
            {{ option }}
          </option>
        </select>
      </div>
      <div class="form-group">
        <button type="submit" class="form-input">Create New Task</button>
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