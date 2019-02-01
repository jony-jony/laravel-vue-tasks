<template>
  <v-layout aling-center justify-center row wrap>
    <v-flex xs12 sm12 md12 lg6 xl6>
      <form-task @load-tasks="loadTasks" @add-task="addTask"/>
      <loader class="mt-3" v-show="loadingTasks"/>
      <v-card class="mt-3" v-show="tasks.length">
        <v-card-text>
          <v-slide-y-transition
            group
            tag="v-list">
            <task
              v-for="(task, index) in tasks"
              :key="task.id"
              :index="index"
              :task="task"
              @delete-task="deleteTask(index, ...arguments)"/>
          </v-slide-y-transition>
        </v-card-text>
      </v-card>
      <v-snackbar
      v-model="snackbarFinishedTask">
        Task finished
        <v-btn
        flat
        color="pink"
        :loading="undoFinishedTask"
        :disabled="undoFinishedTask"
        @click="restoreFinishedTask">
          undo
        </v-btn>
      </v-snackbar>
      <v-snackbar
        v-model="snackbarDeletedTask">
        Task deleted
        <v-btn
          flat
          color="pink"
          :loading="undoDeletedTask"
          :disabled="undoDeletedTask"
          @click="restoreDeletedTask">
          undo
        </v-btn>
      </v-snackbar>
    </v-flex>
    <dialog-form-edit-task @update-task="updateTask"/>
  </v-layout>
</template>

<script>
    import Task from './Task';
    import Loader from '../Loader';
    import FormTask from './FormTask';
    import DialogFormEditTask from './DialogFormEditTask';

    export default {
        name: "TasksContainer",
        components: {FormTask, DialogFormEditTask, Task, Loader},
        data() {
            return {
                tasks: [],
                loadingTasks: true,
                undoFinishedTask: false,
                undoDeletedTask: false,
                snackbarFinishedTask: false,
                snackbarDeletedTask: false,
                lastDeletedTask: {}
            };
        },
        mounted() {
            this.loadTasks();
        },
        methods: {
            loadTasks() {
                this.loadingTasks = true;
                axios.get('/tasks')
                .then(response => {
                    this.tasks = response.data.tasks;
                })
                .catch(error => {
                    this.globalError();
                }).then(() => {
                    this.loadingTasks = false;
                });
            },
            addTask(task) {
                this.tasks.push(task);
            },
            updateTask(updateTask) {
                let task = this.tasks[updateTask.index];
                task.title = updateTask.title;
                task.description = updateTask.description;
                task.updated_at = moment().toDate();
            },
            deleteTask(index, showSnackbarDeletedTask = false, showSnackbarFinishedTask = false) {
                this.lastDeletedTask = this.tasks[index];
                this.tasks.splice(index, 1);
                if(showSnackbarDeletedTask) {
                    this.snackbarDeletedTask = true;
                }
                if(showSnackbarFinishedTask) {
                    this.snackbarFinishedTask = true;
                }
            },
            restoreFinishedTask() {
                this.undoFinishedTask = true;
                this.snackbarFinishedTask = false;
                axios.put(`tasks/${this.lastDeletedTask.id}/restore-finished`)
                     .then(response => {
                         this.tasks.push(this.lastDeletedTask);
                         this.lastDeletedTask = {};
                     })
                     .catch(error => {
                         this.globalError();
                     }).then(() => this.undoFinishedTask = false);
            },
            restoreDeletedTask() {
                this.undoDeletedTask = true;
                this.snackbarDeletedTask = false;
                axios.put(`tasks/${this.lastDeletedTask.id}/restore-deleted`)
                     .then(response => {
                         this.tasks.push(this.lastDeletedTask);
                         this.lastDeletedTask = {};
                     })
                     .catch(error => {
                         this.globalError();
                     }).then(() => this.undoDeletedTask = false);
            }
        }
    }
</script>