require('./bootstrap')

import Vue from 'vue'
Vue.config.devtools = true
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import moment from 'moment'
// Vue.config.productionTip = false
Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('llll')
    }
})
// Router import
import { routes } from './routes'

// Import User Class
import User from './Helpers/User'
window.User = User

// Import Notification Class
import Notification from './Helpers/Notification'
window.Notification = Notification

// Sweet Alert
import Swal from 'sweetalert2'
window.Swal = Swal

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
})

window.Toast = Toast
window.Reload = new Vue()

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: 'history'
})

const app = new Vue({
    el: '#app',
    router
})
