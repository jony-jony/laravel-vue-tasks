<template>
  <div>
    <nav-bar/>
    <div class="container mt-4">
      <slot/>
    </div>
  </div>
</template>

<script>
    import NavBar from '../layouts/NavBar';

    export default {
        name: "MainLayout",
        components: {NavBar}
    }
</script>