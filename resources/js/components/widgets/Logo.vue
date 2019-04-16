<template>
  <img
    :src="uri"
    alt=""
  >
</template>

<script>
  export default {
    props: {
      uri: String,
    },
  }
</script>
