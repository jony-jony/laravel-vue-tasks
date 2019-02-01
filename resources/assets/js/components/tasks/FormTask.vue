<template>
  <v-card>
    <v-card-text>
      <v-form ref="form" @submit.prevent="store">
        <v-text-field
          v-model="title"
          :rules="taskRules"
          label="Task"
          required/>
        <v-textarea
          v-model="description"
          label="Description"/>
      </v-form>
    </v-card-text>
    <v-card-actions>
      <v-spacer/>
      <v-btn outline color="info" @click="reloadTasks">refresh</v-btn>
      <v-btn outline color="success" :loading="storing" :disabled="storing" @click="store">save</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
    export default {
        name: "FormTask",
        data() {
            return {
                title: '',
                description: '',
                storing: false,
                taskRules: [
                    v => !!v || 'This field is required'
                ]
            };
        },
        methods: {
            reloadTasks() {
                this.$emit('load-tasks');
            },
            store() {
                if(this.$refs.form.validate()) {
                    this.storing = true;
                    let task = {
                        title: this.title,
                        description: this.description
                    };
                    axios.post('tasks', task)
                         .then(response => {
                             this.title = '';
                             this.description = '';
                             this.$emit('add-task', response.data.task);
                             this.$refs.form.reset();
                         })
                         .catch(error => {
                            this.globalError();
                         })
                         .then(() => this.storing = false);
                }
            }
        }
    }
</script>