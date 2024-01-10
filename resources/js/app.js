import Vue from 'vue'
import App from './views/App'
import router from './router'

const app = new Vue({
    el: '#app',
    components: { App },
    router
})

export default app
