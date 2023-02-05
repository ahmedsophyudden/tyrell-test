require('./bootstrap')

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import router from "./routers/index";
// import asset from "./mixins/asset";
import App from './App.vue'
import { useAuthStore } from '@/stores/auth';

// import argon template
import "./plugins/argon/assets/css/nucleo-icons.css";
import "./plugins/argon/assets/css/nucleo-svg.css";
import argonDashboard from "./plugins/argon/argon-dashboard";


(async () => {
    // const authStore = useAuthStore(createPinia())
    // await authStore.checkSession();

    const app = createApp({})
    app.use(createPinia())
    app.use(argonDashboard)
    app.use(router)
    // app.mixin(asset)
    // app.config.globalProperties.$session = authStore.session;
    app.component('App', App)
    app.mount('#app')
})();