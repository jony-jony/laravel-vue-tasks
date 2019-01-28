<template>
  <main-layout>
    <div class="row justify-content-center">
      <div class="col-sm-12 col-md-8 col-lg-8">
        <loader :showLoading="loading"/>
        <div class="list-group">
          <div class="list-group-item" v-for="task in finishedTasks">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">{{ task.title }}</h5>
            </div>
            <p class="mb-1">{{ task.description }}</p>
            <small>Finished at: {{ formatDate(task.updated_at) }}</small>
          </div>
        </div>
        <div class="mt-1 float-right">
          <button type="button" class="btn btn-outline-primary" v-show="currentPage > 1" @click="loadFinishedTasks(currentPage - 1)">Anterior</button>
          <button type="button" class="btn btn-outline-primary" v-show="currentPage < lastPage" @click="loadFinishedTasks(currentPage + 1)">Siguiente</button>
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
                finishedTasks: [],
                currentPage: 1,
                lastPage: 0,
                loading: true
            }
        },
        created() {
            this.loadFinishedTasks(this.currentPage);
        },
        methods: {
            loadFinishedTasks(page) {
                this.loading = true;
                this.finishedTasks = [];
                axios.get('finished-tasks', {
                          params: {
                              page: page
                          }
                      })
                     .then(response => {
                         let finishedTasks = response.data.finishedTasks;
                         this.finishedTasks = finishedTasks.data;
                         this.currentPage = finishedTasks.current_page;
                         this.lastPage = finishedTasks.last_page;
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
                     }).then(() => this.loading = false);
            }
        }
    }
</script>