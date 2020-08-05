import Vue from 'vue';
import router from './router/index';
import App from './App';
import VueCookies from 'vue-cookies';
import store from './store/index';

require('./bootstrap');
require('./store/subscriber')

axios.defaults.baseURL = 'http://localhost:8000/api';

Vue.use(VueCookies);

store.dispatch('auth/attempt', localStorage.getItem('token')).then(() => {
    new Vue({
        router,
        store,
        render: h => h(App)
    }).$mount('#app')
})
