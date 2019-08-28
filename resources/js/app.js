require('./bootstrap')

import Vue from 'vue'
Vue.config.devtools = true
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// Router import
import { routes } from './routes'

// Import User Class
import User from './Helpers/User'
window.User = User

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: 'history'
})

const app = new Vue({
    el: '#app',
    router
})
