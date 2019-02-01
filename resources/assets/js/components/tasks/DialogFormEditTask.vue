<template>
  <v-dialog v-model="showDialog" persistent max-width="600px">
    <v-card>
      <v-card-title>
        <span class="headline">Edit Task</span>
      </v-card-title>
      <v-card-text>
        <v-form ref="formEdit" @submit.prevent="update">
          <v-text-field
            v-model="titleEdit"
            :rules="taskRules"
            label="Task"
            required/>
          <v-textarea
            v-model="descriptionEdit"
            label="Description"/>
        </v-form>
      </v-card-text>
      <v-card-actions>
        <v-spacer/>
        <v-btn flat @click="showDialog = false">cancel</v-btn>
        <v-btn
          flat
          color="success"
          :loading="updatingTask"
          :disabled="updatingTask"
          @click="update">
          update
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
    export default {
        name: "DialogFormEditTask",
        created() {
            this.$bus.$on('show-dialog-form-edit', (task, index) => {
                this.taskIndex = index;
                this.taskId = task.id;
                this.titleEdit = task.title;
                this.descriptionEdit = task.description;
                this.showDialog = true;
            });
        },
        data() {
            return {
                taskIndex: 0,
                taskId: 0,
                titleEdit: '',
                descriptionEdit: '',
                taskRules: [
                    v => !!v || 'This field is required'
                ],
                showDialog: false,
                updatingTask: false
            };
        },
        methods: {
            update() {
                if(this.$refs.formEdit.validate()) {
                    this.updatingTask = true;
                    let task = {
                        title: this.titleEdit,
                        description: this.descriptionEdit
                    };
                    axios.put(`tasks/${this.taskId}`, task)
                         .then(response => {
                             this.showDialog = false;
                             task.index = this.taskIndex;
                             this.$emit('update-task', task);
                             this.showMessage('Task updated');
                         })
                         .catch(error => {
                             this.globalError();
                         })
                         .then(() => this.updatingTask = false);
                }
            }
        }
    }
</script>