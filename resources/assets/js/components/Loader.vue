<template>
  <div class="list-group-item d-flex justify-content-center p-4" v-if="showLoading">
    <div class="mr-2">
      <i class="text-primary fas fa-sync fa-spin"></i>
    </div>
    <span>Loading...</span>
  </div>
</template>

<script>
    export default {
        name: "Loader",
        props: ['showLoading']
    }
</script>

<style scoped>

</style>