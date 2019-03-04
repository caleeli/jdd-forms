import Vue from 'vue'
import App from './App.vue'
import Vuex from 'vuex';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';

window.Vue = Vue;
window.Vuex = Vuex;

Vue.use(Vuex);

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
}).$mount('#app')
