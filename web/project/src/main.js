import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import axios from 'axios'
import Vuelidate from 'vuelidate';
import VueFlashMessage from 'vue-flash-message';




Vue.config.productionTip = false
Vue.prototype.$http = axios;

const token = localStorage.getItem('token')

Vue.use(Vuelidate);
Vue.use(VueFlashMessage, {
    messageOptions: {
        timeout: 2000,
    }
});

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
