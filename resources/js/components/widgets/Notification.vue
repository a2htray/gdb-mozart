<template>
  <v-menu offset-y origin="center center" class="elelvation-1" :nudge-bottom="14" transition="scale-transition">
    <v-btn icon flat slot="activator">
      <v-badge color="red" overlap>
        <span slot="badge">{{ total }}</span>
        <v-icon medium>notifications</v-icon>
      </v-badge>
    </v-btn>
    <v-card class="elevation-0">
      <v-toolbar card dense color="transparent">
        <v-toolbar-title><h4>Notification</h4></v-toolbar-title>
      </v-toolbar>
      <v-divider></v-divider>
      <v-card-text class="pa-0">
        <v-list two-line class="pa-0">
          <template v-for="(item, index) in items">
            <v-subheader v-if="item.header" :key="item.header">{{ item.header }}</v-subheader>
            <v-divider v-else-if="item.divider" :key="index"></v-divider>
            <v-list-tile avatar v-else :key="item.title" :href="item.href">
              <v-list-tile-avatar :color="item.color">
                <v-icon dark>{{item.icon}}</v-icon>
              </v-list-tile-avatar>
              <v-list-tile-content>
                <v-list-tile-sub-title v-html="item.title"></v-list-tile-sub-title>
              </v-list-tile-content>
              <v-list-tile-action class="caption">
                {{item.timeLabel}}
              </v-list-tile-action>
            </v-list-tile>
          </template>
        </v-list>
        <v-divider></v-divider>
        <v-btn block flat class="ma-0" :href="href">All</v-btn>
        <v-divider></v-divider>
      </v-card-text>
    </v-card>
  </v-menu>
</template>

<script>
  export default {
    props: {
      total: String,
      items: Array,
      href: String,
    }
  }
</script>
