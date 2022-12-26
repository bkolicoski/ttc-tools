require('./bootstrap');

import Vue from 'vue'

Vue.component('link-extractor', require('./components/LinkExtractor.vue').default);
Vue.component('youtube-latest', require('./components/YouTubeLatest.vue').default);
Vue.component('youtube-playlist-latest', require('./components/YouTubePlaylistLatest.vue').default);

const app = new Vue({
    el: '#app'
});
