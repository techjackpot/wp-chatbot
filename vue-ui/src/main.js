import Vue from 'vue'
import ChatBot from './components/ChatBot';

Vue.config.productionTip = false

if (document.getElementById('chatbot-widget')) {
  new Vue({
    render: h => h(ChatBot)
  }).$mount('#chatbot-widget')
}
