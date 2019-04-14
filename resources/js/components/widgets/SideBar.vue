<template>
  <v-navigation-drawer
    fixed
    :model="true"
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
            <!--sub group-->
            <!--<v-list-group v-if="subItem.items" :key="subItem.name" :group="subItem.group" sub-group="sub-group">-->
              <!--<v-list-tile slot="activator" ripple="ripple">-->
                <!---->
                <!--<v-list-tile-content>-->
                  <!--<v-list-tile-title>{{ subItem.title }}</v-list-tile-title>-->
                <!--</v-list-tile-content>-->
              <!--</v-list-tile>-->
              <!--<v-list-tile v-for="(grand, i) in subItem.children" :key="i" :href="grand.href" ripple="ripple">-->
                <!---->
                <!--<v-list-tile-content>-->
                  <!--<v-list-tile-title>{{ grand.title }}</v-list-tile-title>-->
                <!--</v-list-tile-content>-->
              <!--</v-list-tile>-->
            <!--</v-list-group>-->
            <v-list-tile :key="i" :href="subItem.href" :disabled="subItem.disabled" :target="subItem.target" ripple="ripple">
              <v-list-tile-action v-if="subItem.icon">
                <v-icon>{{ item.icon }}</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title><span>{{ subItem.title }}</span></v-list-tile-title>
              </v-list-tile-content>
              <v-list-tile-action v-if="subItem.action">
                <v-icon :class="[subItem.actionClass || 'success--text']">{{ subItem.action }}</v-icon>
              </v-list-tile-action>
            </v-list-tile>
          </template>
        </v-list-group>
        <!--<v-subheader v-else-if="item.header" :key="i">{{ item.header }}</v-subheader>-->
        <!--<v-divider v-else-if="item.divider" :key="i"></v-divider>-->
        <!--top-level link-->
        <v-list-tile v-else :href="item.href" ripple="ripple" :disabled="item.disabled" :target="item.target" rel="noopener" :key="item.name">
          <v-list-tile-action v-if="item.icon">
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ item.title }}</v-list-tile-title>
          </v-list-tile-content>
          <v-list-tile-action v-if="item.subAction">
            <v-icon class="success--text">{{ item.subAction }}</v-icon>
          </v-list-tile-action>
        </v-list-tile>
      </template>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
  export default {
    data: () => {
      return {
      }
    },
    props: {
      items: Array,
    }
  }
</script>
