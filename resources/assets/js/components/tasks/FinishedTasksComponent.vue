<template>
  <main-layout>
    <div class="row justify-content-center">
      <div class="col-sm-12 col-md-8 col-lg-8">
        <div class="list-group">
          <div class="list-group-item" v-for="task in finishedTasks">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">{{ task.title }}</h5>
            </div>
            <p class="mb-1">{{ task.description }}</p>
            <small>Finished at: {{ formatDate(task.updated_at) }}</small>
          </div>
        </div>
      </div>
    </div>
  </main-layout>
</template>

<script>
    import MainLayout from '../layouts/MainLayout';

    export default {
        name: "FinishedTasksComponent",
        components: {MainLayout},
        data() {
            return {
                finishedTasks: []
            }
        },
        created() {
            this.loadFinishedTasks();
        },
        methods: {
            loadFinishedTasks() {
                axios.get('finished-tasks')
                     .then(response => {
                         this.finishedTasks = response.data.finishedTasks;
                         if(this.finishedTasks.length === 0) {
                             swal({
                                 type: 'info',
                                 text: "You don't have finished tasks"
                             });
                         }
                     })
                     .catch(error => {
                         swal({
                             type: 'error',
                             text: 'Something went wrong!, try it again'
                         });
                     });
            }
        }
    }
</script>