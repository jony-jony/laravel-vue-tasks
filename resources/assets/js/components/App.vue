<template>
  <v-app>
    <nav-bar/>
    <v-content>
      <v-container>
        <v-fade-transition mode="out-in">
          <router-view/>
        </v-fade-transition>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
    import NavBar from './layouts/NavBar';

    export default {
        name: "App",
        components: {NavBar}
    }
</script>