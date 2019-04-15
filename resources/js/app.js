import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/src/stylus/main.styl'

Vue.use(Vuetify)

Vue.component('m-login-panel', require('./components/LoginPanel.vue').default)

Vue.component('m-dashboard', require('./components/Dashboard.vue').default)
Vue.component('m-logo', require('./components/widgets/Logo.vue').default)

Vue.component('m-avatar', require('./components/widgets/Avatar.vue').default)
Vue.component('m-notification', require('./components/widgets/Notification.vue').default)
Vue.component('m-sidebar', require('./components/widgets/SideBar.vue').default)

new Vue({
  el: '#app'
})
