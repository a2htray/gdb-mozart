<template>
  <div>
    <v-breadcrumbs :items="items" divider=">"></v-breadcrumbs>
  </div>
</template>

<script>
  export default {
    data: () => ({
    }),
    props: {
      items: Array,
    }
  }
</script>
