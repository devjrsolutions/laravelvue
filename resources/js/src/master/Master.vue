<template>
  <v-card
    max-width="500"
    class="mx-auto"
  >
    <v-toolbar
      color="teal"
      dark
    >
      <v-app-bar-nav-icon></v-app-bar-nav-icon>

      <v-toolbar-title>Topics</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-dots-vertical</v-icon>
      </v-btn>
    </v-toolbar>

    <v-list>
      <v-list-group
        v-for="item in items"
        :key="item.title"
        v-model="item.active"
        :prepend-icon="item.action"
        no-action
      >
        <template v-slot:activator>
          <v-list-item-content>
            <v-list-item-title v-text="item.title"></v-list-item-title>
          </v-list-item-content>
        </template>

        <v-list-item
          v-for="subItem in item.items"
          :key="subItem.title"
          @click=""
        >
          <v-list-item-content>
            <v-list-item-title v-text="subItem.title"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-group>
    </v-list>
  </v-card>
</template>
<script>
  export default {
    data () {
      return {
        items: [
          {
            action: 'dashboard',
            title: 'Dashboard',
           
          },
          {
            action: 'assignment',
            title: 'Interaksi',
            active: true,
          },
          {
            action: 'person',
            title: 'User',
          },
          {
            action: 'cloud_circle',
            title: 'Files',
          },
          {
            action: 'folder_shared',
            title: 'Master',
            items: [
              { title: 'Advertise' },
              { title: 'Confirm Status' },
              { title: 'Gender' },
            ],
          },
        ],
      }
    },
  }
</script>