import Vue from 'vue'

import Chat from 'vue-beautiful-chat'
Vue.use(Chat)

Vue.config.productionTip = false

import VueResource from 'vue-resource'
Vue.use(VueResource)

const API_BASE_URL = process.env.NODE_ENV == 'production' ? 'https://iq.sixaxisllc.com' : 'http://127.0.0.1:9001' // 'https://api-sixaxis.ngrok.io'
// const API_BASE_URL = 'http://127.0.0.1:9001' // 'https://api-sixaxis.ngrok.io'
Vue.http.options.root = API_BASE_URL

import ChatBot from './components/ChatBot';

if (document.getElementById('chatbot-widget')) {
  new Vue({
    render: h => h(ChatBot)
  }).$mount('#chatbot-widget')
}
