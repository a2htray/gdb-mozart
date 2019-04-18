<template>
  <v-toolbar-side-icon @click="sidebarOffset"></v-toolbar-side-icon>
</template>

<script>
  export default {
    methods: {
      sidebarOffset () {
        this.$root.$emit('sidebarOffset')
      }
    }
  }
  
</script>
