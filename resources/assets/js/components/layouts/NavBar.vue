<template>
  <div>
    <v-toolbar app dark color="primary">
      <v-toolbar-side-icon class="hidden-md-and-up" @click.stop="drawer = !drawer"/>
      <v-toolbar-title>Laravel & Vue</v-toolbar-title>
      <v-toolbar-items class="hidden-sm-and-down">
        <v-btn flat v-for="menu in menus" :key="menu.title" :to="menu.path">{{ menu.title }}</v-btn>
      </v-toolbar-items>
    </v-toolbar>
    <v-navigation-drawer absolute temporary v-model="drawer">
      <v-list>
        <v-list-tile v-for="menu in menus" :key="menu.title" :to="menu.path">
          <v-list-tile-action>
            <font-awesome-icon :icon="menu.icon"/>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ menu.title }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>

<script>
    export default {
        name: "Drawer",
        data() {
            return {
                drawer: null,
                menus: [
                    {
                        title: 'Tasks',
                        icon: 'list',
                        path: '/tasks'
                    },
                    {
                        title: 'Finished Tasks',
                        icon: 'tasks',
                        path: '/finished-tasks'
                    }
                ]
            };
        }
    }
</script>