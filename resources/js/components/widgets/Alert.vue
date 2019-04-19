<template>
  <div style="position: fixed; bottom: 0; right: 0; z-index: 999999; width: 400px;">
    <v-alert
      v-model="alert"
      dismissible
      :type="type"
      :icon="icon"
      v-for="message in messages"
      key="index"
    >
      {{ message }}
    </v-alert>
  </div>
</template>

<script>
  const COLOR_ICON_MAP = {
    'success': 'check_circle',
    'info': 'info',
    'warning': 'priority_high',
    'error': 'warning',
  }
  export default {
    data: () => ({
      alert: false,
      type: 'success',
      messages: [],
      icon: 'check_circle'
    }),
    methods: {
    },
    mounted () {
      this.$root.$on('alert', (type, messages) => {
        this.alert = true
        this.messages = messages
        this.type = type
        this.icon = COLOR_ICON_MAP[this.type]
      })
    }
  }
</script>
