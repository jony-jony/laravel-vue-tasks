<template>
  <div>
    <v-divider v-if="index !== 0"/>
    <v-list-tile>
      <v-list-tile-content :title="`created at ${formatDate(task.created_at)} - updated at ${formatDate(task.updated_at)}`">
        <v-list-tile-title>{{ task.title }}</v-list-tile-title>
        <v-list-tile-sub-title class="text--primary">{{ task.description }}</v-list-tile-sub-title>
      </v-list-tile-content>
      <v-list-tile-action>
        <v-tooltip top>
          <v-btn
            icon
            outline
            slot="activator"
            color="success"
            :loading="finishingTask"
            :disabled="finishingTask"
            @click="finish">
            <font-awesome-icon icon="check"/>
          </v-btn>
          <span>finish task</span>
        </v-tooltip>
      </v-list-tile-action>
      <v-list-tile-action>
        <v-tooltip top>
          <v-btn
            icon
            outline
            slot="activator"
            color="primary"
            @click="edit">
            <font-awesome-icon icon="pen"/>
          </v-btn>
          <span>edit task</span>
        </v-tooltip>
      </v-list-tile-action>
      <v-list-tile-action>
        <v-tooltip top>
          <v-btn
            icon
            outline
            slot="activator"
            color="error"
            :loading="deletingTask"
            :disabled="deletingTask"
            @click="destroy">
            <font-awesome-icon icon="trash-alt"/>
          </v-btn>
          <span>delete task</span>
        </v-tooltip>
      </v-list-tile-action>
    </v-list-tile>
  </div>
</template>

<script>
    export default {
        name: 'Task',
        props: ['index', 'task'],
        data() {
            return {
                finishingTask: false,
                deletingTask: false,
            };
        },
        methods: {
            edit() {
                this.$bus.$emit('show-dialog-form-edit', this.task, this.index);
            },
            finish() {
                this.finishingTask = true;
                axios.put(`tasks/${this.task.id}/finish`)
                     .then(response => this.$emit('delete-task', false, true))
                     .catch(error => {
                         this.globalError();
                     })
                     .then(() => this.finishingTask = false);
            },
            destroy() {
                this.deletingTask = true;
                axios.delete(`/tasks/${this.task.id}`)
                     .then(response => {
                         this.$emit('delete-task', true);
                     })
                     .catch(error => {
                         this.globalError();
                     }).then(() => this.deletingTask = false);
            }
        }
    }
</script>