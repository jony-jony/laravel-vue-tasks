<template>
  <div class="card">
    <div class="card-header">My Tasks</div>
    <div class="card-body">
      <form id="formTask" @submit.prevent="store" novalidate>
        <div class="form-row mb-3">
          <div class="col-sm-12 col-md-12 col-lg-12">
            <label for="task">Task</label>
            <input id="task" type="text" class="form-control" v-model="title" required>
            <div class="invalid-feedback">this field is required</div>
          </div>
          <div class="col-sm-12 col-md-12 col-lg-12">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" rows="3" v-model="description" required></textarea>
            <div class="invalid-feedback">this field is required</div>
          </div>
        </div>
        <button type="button" class="btn btn-outline-success" v-if="savingMode" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          saving...
        </button>
        <button type="submit" class="btn btn-outline-success" v-else>Save</button>
        <button type="button" class="btn btn-outline-info" v-if="loadingMode" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          reloading...
        </button>
        <button type="button" class="btn btn-outline-info" v-else @click="loadTasks">Reload tasks</button>
      </form>
    </div>
  </div>
</template>

<script>
    export default {
        name: 'FormTaskComponent',
        data() {
            return {
                title: '',
                description: '',
                loadingMode: false,
                savingMode: false,
            };
        },
        methods: {
            loadTasks() {
                this.loadingMode = true;
                this.$emit('loadTasks');
            },
            store() {
                let form = document.getElementById('formTask');
                if(form.checkValidity()) {
                    form.classList.remove('was-validated');
                    this.savingMode = true;
                    let task = {
                        title: this.title,
                        description: this.description
                    };
                    axios.post('tasks', task)
                         .then(response => {
                             this.title = '';
                             this.description = '';
                             this.$emit('addTask', response.data.task);
                         })
                         .catch(error => {
                             swal({
                                 type: 'error',
                                 text: 'Something went wrong!, try it again'
                             });
                         })
                         .then(() => this.savingMode = false);
                } else {
                    form.classList.add('was-validated');
                }
            }
        }
    }
</script>