import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/src/stylus/main.styl'

Vue.use(Vuetify)

Vue.component('m-dashboard', require('./components/Dashboard.vue').default)
Vue.component('m-logo', require('./components/widgets/Logo.vue').default)

new Vue({
  el: '#app'
})
