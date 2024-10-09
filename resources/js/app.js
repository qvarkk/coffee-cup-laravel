// import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import Index from './components/Index.vue';
import router from "./router.js";

app.component('index', Index);

app.use(router);

app.mount('#app');
