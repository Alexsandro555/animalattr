/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'

import Vue from 'vue'
window.Vue = Vue

/**
 * Initialize main libraries
 */
//===========Vuex==========================================
import Vuex from 'vuex'
Vue.use(Vuex)
//==========Vuetify========================================
import Vuetify from 'vuetify'
// Импорт CSS-файлов, которые могут потребоваться
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify)
//==========Router=========================================
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import { routes } from './routes'
const router = new VueRouter({
  routes
})

import dateFns from 'date-fns'
// объявление глобальной библиотеки
Vue.mixin(
  {
    data() { return { dateFns } },
  }
)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

//window.dark = true

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import createStore from './vuex/states.js'
import { mapActions, mapMutations } from 'vuex'

import Notifications from '@/vue/Notifications.vue'
Vue.component('notifications', Notifications)

const app = new Vue({
  el: '#app',
  router,
  store: new Vuex.Store(createStore()),
  created() {
    this.init()
  },
  data() {
    return {
      dark: true
    }
  },
  methods: {
    // инициализирует перехват обработки ошибок
    ...mapActions('initializer',{init: 'init'}),
  }
});
