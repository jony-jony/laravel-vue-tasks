<template>
  <main-layout>
    <div class="row justify-content-center">
      <div class="col-sm-12 col-md-8 col-lg-8">
        <form-task-component ref="formTask" @addTask="addTask" @loadTasks="loadTasks"></form-task-component>
        <div class="list-group mt-1">
          <loader :showLoading="loading"/>
          <task-component
            v-for="(task, index) in tasks"
            :key="task.id"
            :task="task"
            @deleteTask="deleteTask(index, ...arguments)">
          </task-component>
        </div>
      </div>
    </div>
  </main-layout>
</template>

<script>
    import MainLayout from '../layouts/MainLayout';
    import FormTaskComponent from './FormTaskComponent';
    import TaskComponent from './TaskComponent';

    export default {
        name: 'TaskContainerComponent',
        components: {MainLayout, FormTaskComponent, TaskComponent},
        data() {
            return {
                tasks: [],
                loading: true
            };
        },
        created() {
            this.loadTasks();
        },
        methods: {
            loadTasks() {
                this.tasks = [];
                this.loading = true;
                axios.get('tasks')
                     .then(response => {
                         this.tasks = response.data.tasks;
                         if(this.tasks.length === 0) {
                             swal({
                                 type: 'info',
                                 text: 'Your task list is empty'
                             });
                         }
                     })
                     .catch(error => {
                         swal({
                             type: 'error',
                             text: 'Something went wrong!, try it again'
                         });
                     }).then(() => {
                         this.$refs.formTask.loadingMode = false;
                         this.loading = false;
                     });
            },
            addTask(task) {
                this.tasks.push(task);
            },
            deleteTask(index) {
                this.tasks.splice(index, 1);
            }
        }
    }
</script>
