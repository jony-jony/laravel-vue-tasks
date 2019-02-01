<template>
  <v-layout aling-center justify-center row wrap>
    <v-flex xs12 sm12 md12 lg6 xl6>
      <loader v-show="loading"/>
      <v-card class="mt-3" v-show="finishedTasks.length">
        <v-card-text>
          <v-list two-line>
            <template v-for="(task, index) in finishedTasks">
              <v-divider v-if="index !== 0"/>
              <v-list-tile>
                <v-list-tile-content>
                  <v-list-tile-title>{{ task.title }}</v-list-tile-title>
                  <v-list-tile-sub-title class="text--primary">{{ task.description }}</v-list-tile-sub-title>
                  <v-list-tile-sub-title>Finished at: {{ formatDate(task.updated_at) }}</v-list-tile-sub-title>
                </v-list-tile-content>
              </v-list-tile>
            </template>
          </v-list>
        </v-card-text>
        <v-card-actions>
          <v-spacer/>
          <v-btn
            outline
            color="info"
            v-show="currentPage > 1"
            @click="loadFinishedTasks(currentPage - 1)">
            Previous
          </v-btn>
          <v-btn
            outline
            color="info"
            v-show="currentPage < lastPage"
            @click="loadFinishedTasks(currentPage + 1)">
            Next
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
    import Loader from '../Loader';

    export default {
        name: "FinishedTasks",
        components: {Loader},
        data() {
            return {
                finishedTasks: [],
                currentPage: 1,
                lastPage: 0,
                loading: true
            }
        },
        mounted() {
            this.loadFinishedTasks(this.currentPage);
        },
        methods: {
            loadFinishedTasks(page) {
                this.loading = true;
                this.finishedTasks = [];
                axios.get('finished-tasks', {
                    params: {
                        page: page
                    }
                })
                .then(response => {
                    let finishedTasks = response.data.finishedTasks;
                    this.finishedTasks = finishedTasks.data;
                    this.currentPage = finishedTasks.current_page;
                    this.lastPage = finishedTasks.last_page;
                    if(this.finishedTasks.length === 0) {
                        swal({
                            type: 'info',
                            text: "You don't have finished tasks"
                        });
                    }
                })
                .catch(error => {
                    this.globalError();
                }).then(() => this.loading = false);
            }
        }
    }
</script>