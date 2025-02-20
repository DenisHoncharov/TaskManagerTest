<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

const router = useRouter();
const token = ref(localStorage.getItem("token") || "");

onMounted(() => {
  token.value = localStorage.getItem("token") || "";
});

function logout() {
  axios.get("logout")
      .then(() => {
        localStorage.removeItem("token");
        axios.defaults.headers.common["Authorization"] = "";
        token.value = "";
        router.push({ name: "login" });
      })
      .catch(error => {
        console.error(error);
      });
}
</script>

<template>
  <header>
    <div class="wrapper">
      <nav>
        <RouterLink to="/">Home</RouterLink>
        <RouterLink v-if="!token" to="/login">Login</RouterLink>
        <RouterLink v-if="!token" to="/registration">Registration</RouterLink>
        <RouterLink v-if="token" to="/tasks">Tasks</RouterLink>
        <button v-if="token" @click="logout">Logout</button>
      </nav>
    </div>
  </header>

  <RouterView />
</template>


<style scoped>
header {
  line-height: 1.5;
  max-height: 100vh;
}

nav {
  width: 100%;
  font-size: 12px;
  text-align: center;
  margin-top: 2rem;
}

nav a.router-link-exact-active {
  color: var(--color-text);
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}

nav a {
  display: inline-block;
  padding: 0 1rem;
  border-left: 1px solid var(--color-border);
}

nav a:first-of-type {
  border: 0;
}

@media (min-width: 1024px) {
  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }

  nav {
    text-align: center;
    font-size: 1rem;

    padding: 1rem 0;
    margin-top: 1rem;
  }
}
</style>
