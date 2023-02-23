import Vue from 'vue'

import Chat from 'vue-beautiful-chat'
Vue.use(Chat)

Vue.config.productionTip = false

import ChatBot from './components/ChatBot';

if (document.getElementById('chatbot-widget')) {
  new Vue({
    render: h => h(ChatBot)
  }).$mount('#chatbot-widget')
}
