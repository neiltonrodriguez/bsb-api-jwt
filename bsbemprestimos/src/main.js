import { createApp } from 'vue'
import './assets/css/app.css'
import App from './App.vue'
import router from './router'
import { createPinia } from 'pinia'
import VueTheMask from 'vue-the-mask'

import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";

createApp(App)
    .use(createPinia())
    .use(router)
    .use(VueSweetalert2)
    .use(VueTheMask)
    .mount('#app')
