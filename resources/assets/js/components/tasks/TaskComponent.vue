<template>
  <div class="list-group-item flex-column align-items-start">
    <div v-if="editMode">
      <form id="formTask" @submit.prevent="update" novalidate>
        <div class="form-row mb-3">
          <div class="col-sm-12 col-md-12 col-lg-12">
            <label for="task">Task</label>
            <input id="task" type="text" class="form-control" v-model="task.title" required>
            <div class="invalid-feedback">this field is required</div>
          </div>
          <div class="col-sm-12 col-md-12 col-lg-12">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" rows="3" v-model="task.description" required></textarea>
            <div class="invalid-feedback">this field is required</div>
          </div>
        </div>
        <button type="submit" class="btn btn-outline-success">Save</button>
        <button type="button" class="btn btn-outline-secondary" @click="cancelEdit">Cancel</button>
      </form>
    </div>
    <div v-else>
      <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">{{ task.title }}</h5>
        <small class="text-muted">
          <button class="btn btn-outline-primary" title="edit task" @click="edit">
            <i class="fas fa-edit"></i>
          </button>
          <button class="btn btn-outline-danger" title="delete task" @click="destroy">
            <i class="fas fa-trash-alt"></i>
          </button>
        </small>
      </div>
      <p class="mb-1">{{ task.description }}</p>
      <small class="text-muted">Created at: {{ task.created_at }} - Updated at: {{ task.updated_at }}</small>
    </div>
  </div>
</template>

<script>
    export default {
        name: 'TaskComponent',
        props: ['task'],
        data() {
            return {
                editMode: false,
                previousTask: {}
            };
        },
        methods: {
            edit() {
                this.previousTask = Object.assign({}, this.task);
                this.editMode = true;
            },
            cancelEdit() {
                this.editMode = false;
                this.task = this.previousTask;
                this.previousTask = {};
            },
            update() {
                axios.put(`tasks/${this.task.id}`, this.task)
                     .then(response => {
                         this.editMode = false;
                         this.$emit('updateTask', response.data.task);
                     })
                     .catch(error => alert(error));
            },
            destroy() {
                axios.delete(`tasks/${this.task.id}`)
                     .then(response => this.$emit('deleteTask'))
                     .catch(error => alert(error));
            }
        }
    }
</script>