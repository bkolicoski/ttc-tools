import './bootstrap';

import { createApp } from 'vue';

import LinkExtractor from './components/LinkExtractor.vue';
import YouTubeLatest from './components/YouTubeLatest.vue';
import YouTubePlaylistLatest from './components/YouTubePlaylistLatest.vue';

createApp({})
    .component('link-extractor', LinkExtractor)
    .component('youtube-latest', YouTubeLatest)
    .component('youtube-playlist-latest', YouTubePlaylistLatest)
    .mount('#app');
