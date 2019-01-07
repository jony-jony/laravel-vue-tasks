<template>
  <div class="list-group-item flex-column align-items-start">
    <div v-if="editMode">
      <form :id="`formEditTask${task.id}`" @submit.prevent="update" novalidate>
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
        <button class="btn btn-outline-success" type="button" v-if="updatingMode" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          updating...
        </button>
        <button type="submit" class="btn btn-outline-success" v-else>Update</button>
        <button type="button" class="btn btn-outline-secondary" @click="cancelEdit">Cancel</button>
      </form>
    </div>
    <div v-else>
      <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">{{ task.title }}</h5>
        <small class="text-muted">
          <button class="btn btn-outline-primary" title="edit task" @click="edit">
            edit
          </button>
          <button type="button" class="btn btn-outline-danger" v-if="deletingMode" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          </button>
          <button v-else type="button" class="btn btn-outline-danger" title="delete task" @click="destroy">
            delete
          </button>
        </small>
      </div>
      <p class="mb-1">{{ task.description }}</p>
      <small class="text-muted">Created at: {{ formatCreatedAt }} - Updated at: {{ formatUpdatedAt }}</small>
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
                updatingMode: false,
                deletingMode: false,
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
                let form = document.getElementById(`formEditTask${this.task.id}`);
                if(form.checkValidity()) {
                    this.updatingMode = true;
                  axios.put(`tasks/${this.task.id}`, this.task)
                       .then(response => {
                           this.editMode = false;
                           this.$set(this.task, 'updated_at', response.data.task.updated_at);
                           this.$emit('updateTask', this.task);
                       })
                       .catch(error => {
                           swal({
                               type: 'error',
                               text: 'Something went wrong!, try it again'
                           });
                       })
                       .then(() => this.updatingMode = false);
                } else {
                    form.classList.add('was-validated');
                }
            },
            destroy() {
                this.deletingMode = true;
                axios.delete(`tasks/${this.task.id}`)
                     .then(response => this.$emit('deleteTask'))
                     .catch(error => {
                         swal({
                             type: 'error',
                             text: 'Something went wrong!, try it again'
                         });
                     })
                     .then(() => this.deletingMode = false);
            }
        },
        computed: {
            formatCreatedAt() {
                return moment(this.task.created_at).format('DD-MM-YYYY HH:mm');
            },
            formatUpdatedAt() {
                return moment(this.task.updated_at).format('DD-MM-YYYY HH:mm');
            }
        }
    }
</script>