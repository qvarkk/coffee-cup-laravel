// import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});
const pinia = createPinia()

import Index from './components/Index.vue';
import router from "./router.js";
import {createPinia} from "pinia";

app.component('index', Index);

app.use(router);
app.use(pinia)

app.mount('#app');
