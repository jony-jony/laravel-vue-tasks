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
        <button type="submit" class="btn btn-outline-success">Save</button>
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
                description: ''
            };
        },
        methods: {
            store() {
                let form = document.getElementById('formTask');
                if(form.checkValidity()) {
                    form.classList.remove('was-validated');
                    let task = {
                        id: 2,
                        title: this.title,
                        description: this.description
                    };
                    this.$emit('addTask', task);
                    this.title = '';
                    this.description = '';
                } else {
                    form.classList.add('was-validated');
                }
            }
        }
    }
</script>