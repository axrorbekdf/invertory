require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import {routes} from './routes.js'

// User for login and register progress 
import User from './Helpers/User'
window.User = User

// Notification for  progress 
import Notification from './Helpers/Notification'
window.Notification = Notification


// This Swal alert for default alert alternative
import Swal from 'sweetalert2'
window.Swal = Swal;

// This Swal alert global variable 
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

window.Toast = Toast
// Sweet Alert End 

window.Reload = new Vue();


const router = new VueRouter({
    routes,
    mode: 'history'
})


const app = new Vue({
    el: '#app',
    router
});
// .$mount('#app');
