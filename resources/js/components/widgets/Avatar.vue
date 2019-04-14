<template>
  <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition">
    <v-btn icon large flat slot="activator">
      <v-avatar size="30px">
        <img :src="avatarUri" alt="#"/>
      </v-avatar>
    </v-btn>
    <v-list class="pa-0">
      <v-list-tile v-for="(item,index) in items" :to="!item.href ? { name: item.name } : null" :href="item.href" ripple="ripple" :disabled="item.disabled" :target="item.target" rel="noopener" :key="index">
        <v-list-tile-action v-if="item.icon">
          <v-icon>{{ item.icon }}</v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title>{{ item.title }}</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>
    </v-list>
  </v-menu>
</template>

<script>
  export default {
    data: () => {
      return {
      }
    },
    props: {
      avatarUri: String,
      items: Array,
    }
  }
</script>
