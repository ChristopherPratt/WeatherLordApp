

require('./bootstrap');

window.Vue = require('vue').default;


Vue.component('weather-lord', require('./components/WeatherLordVue.vue').default);
Vue.component('about', require('./components/about.vue').default);
Vue.component('dashboard', require('./components/dashboard.vue').default);


const app = new Vue({
    el: '#app',
    //components: { test }
});
