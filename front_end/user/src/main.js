import { createApp } from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
import App from './App.vue'
import router from './router'
import store from "./store/index"
library.add(fab)
library.add(far)
library.add(fas)

createApp(App)
    .use(router)
    .use(store)
    .mount('#app')
