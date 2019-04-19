import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/src/stylus/main.styl'
import NProgress from 'nprogress'
import 'nprogress/nprogress.css'

Vue.use(Vuetify)
Vue.prototype.$NProgress = NProgress

Vue.component('m-login-panel', require('./components/LoginPanel.vue').default)

Vue.component('m-dashboard', require('./components/Dashboard.vue').default)
Vue.component('m-logo', require('./components/widgets/Logo.vue').default)

Vue.component('m-avatar', require('./components/widgets/Avatar.vue').default)
Vue.component('m-notification', require('./components/widgets/Notification.vue').default)
Vue.component('m-sidebar', require('./components/widgets/SideBar.vue').default)
Vue.component('m-tool-side-button', require('./components/widgets/ToolSideButton.vue').default)
Vue.component('m-breadcrumbs', require('./components/widgets/Breadcrumbs.vue').default)
Vue.component('m-table', require('./components/widgets/Table.vue').default)
Vue.component('m-alert', require('./components/widgets/Alert.vue').default)

Vue.component('m-upload-fasta', require('./components/widgets/Setpper.vue').default)
Vue.component('m-obo-panel', require('./components/OboPanel.vue').default)

Vue.component('m-analysis-form', require('./components/form/AnalysisForm.vue').default)
Vue.component('m-organism-form', require('./components/form/OrganismForm.vue').default)



new Vue({
  el: '#app'
})
