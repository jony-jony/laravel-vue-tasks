<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-12 col-md-8 col-lg-8">
        <form-task-component @addTask="addTask"></form-task-component>
        <div class="list-group mt-1">
          <task-component
            v-for="(task, index) in tasks"
            :key="task.id"
            :task="task"
            @updateTask="updateTask(index, ...arguments)"
            @deleteTask="deleteTask(index, ...arguments)">
          </task-component>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        name: 'TaskContainerComponent',
        data() {
            return {
                tasks: []
            };
        },
        created() {
            this.loadTasks();
        },
        methods: {
            loadTasks() {
                axios.get('tasks')
                     .then(response => this.tasks = response.data.tasks)
                     .catch(error => alert(error));
            },
            addTask(task) {
                this.tasks.push(task);
            },
            updateTask(index, task) {
                this.tasks[index] = task;
            },
            deleteTask(index) {
                this.tasks.splice(index, 1);
            }
        }
    }
</script>
