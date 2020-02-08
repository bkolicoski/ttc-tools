require('./bootstrap');

window.Vue = require('vue');

Vue.component('link-extractor', require('./components/LinkExtractor').default);

const app = new Vue({
    el: '#app'
});
