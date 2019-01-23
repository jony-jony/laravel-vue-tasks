<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <router-link to="/tasks" class="navbar-brand">Laravel & Vue</router-link>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <router-link tag="li" to="/tasks" class="nav-item" active-class="active">
          <a class="nav-link">My Tasks</a>
        </router-link>
      </ul>
    </div>
  </nav>
</template>

<script>
    export default {
        name: "NavBar"
    }
</script>