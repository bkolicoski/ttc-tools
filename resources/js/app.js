require('./bootstrap');

window.Vue = require('vue');

Vue.component('link-extractor', require('./components/LinkExtractor').default);
Vue.component('youtube-latest', require('./components/YouTubeLatest').default);

const app = new Vue({
    el: '#app'
});
