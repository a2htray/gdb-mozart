<template>
  <v-navigation-drawer
    disable-resize-watcher
    v-model="openOrClose"
    fixed
    :clipped="$vuetify.breakpoint.mdAndUp"
    app
  >
    <v-list dense expand two-line class="pa-0">
      <template v-for="(item, index) in items">
        <v-list-group v-if="item.items" :key="item.title" :group="item.group" :prepend-icon="item.icon" no-action="no-action">
          <v-list-tile slot="activator" ripple="ripple">
            <v-list-tile-content>
              <v-list-tile-title>{{ item.title }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <template v-for="(subItem, i) in item.items">
            <v-list-tile :key="i" :href="subItem.href" :disabled="subItem.disabled" :target="subItem.target" ripple="ripple">
              <v-list-tile-action v-if="subItem.icon">
                <v-icon :color="subItem.color">{{ subItem.icon }}</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title><span>{{ subItem.title }}</span></v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </template>
        </v-list-group>
        <v-list-tile v-else :href="item.href" ripple="ripple" :disabled="item.disabled" :target="item.target" rel="noopener" :key="item.name">
          <v-list-tile-action v-if="item.icon">
            <v-icon :color="item.color">{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ item.title }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </template>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
  export default {
    data: () => {
      return {
        openOrClose: true,
      }
    },
    props: {
      items: Array,
    },
    mounted () {
      this.$root.$on('sidebarOffset', () => {
        this.openOrClose = !this.openOrClose
      })
    }
  }
</script>
