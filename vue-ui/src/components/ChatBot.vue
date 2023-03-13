<template>
  <div class="chat-bot-wrapper">
    <beautiful-chat
      :participants="participants"
      :onMessageWasSent="onMessageWasSent"
      :messageList="messageList"
      :newMessagesCount="newMessagesCount"
      :isOpen="isChatOpen"
      :close="closeChat"
      :open="openChat"
      :showTypingIndicator="showTypingIndicator"
      :colors="colors"
      :messageStyling="false"
      title="Upside Chat"
      alwaysScrollToBottom
      disableUserListToggle
    >
      <template v-slot:user-avatar="{}">
        <div></div>
      </template>
      <template v-slot:text-message-body="{ message }">
        {{message.data.text | conversion(status, message)}}
      </template>
    </beautiful-chat>
  </div>
</template>

<script>
export default {
  data() {
    return {
      status: {},
      log: {
        ip: '',
        sent: false,
        enter_at: new Date(),
        exit_at: new Date(),
      },
      prefillTimerID: null,
      prefills: [
        {
          id: 'name',
          type: 'name',
          filled: false,
          label: `What is your name?`,
        },
        {
          id: 'email',
          type: 'email',
          filled: false,
          label: `What is your email? (We don't spam... I promise)`,
        },
        {
          id: 'zip',
          type: 'zip',
          filled: false,
          label: `What is your zip/postal code?`,
        },
      ],
      everTouched: false,
      toLead: false,
      touchWords: [
        'quote',
      ],
      positiveWords: [
        'yeah',
        'yes',
        'yep',
      ],
      negativeWords: [
        'no',
        'nah',
        'none',
        'nope',
      ],
      promptTimeout: 300,
      participants: [
        {
          id: 'bot',
          name: 'Support',
        },
      ], // the list of all the participant of the conversation. `name` is the user name, `id` is used to establish the author of a message, `imageUrl` is supposed to be the user avatar.
      messageList: [
        { type: 'text', author: 'bot', data: { text: `Hello, thank you for visiting. How may I help you?` }, },
      ], // the list of the messages to show, can be paginated and adjusted dynamically
      newMessagesCount: 1,
      isChatOpen: false, // to determine whether the chat window should be open or closed
      showTypingIndicator: '', // when set to a value matching the participant.id it shows the typing indicator for the specific user
      colors: {
        header: {
          bg: '#FF8500',
          text: '#fff'
        },
        launcher: {
          bg: '#FF8500'
        },
        messageList: {
          bg: '#fff'
        },
        sentMessage: {
          bg: '#FF8500',
          text: '#fff'
        },
        receivedMessage: {
          bg: '#eaeaea',
          text: '#222222'
        },
        userInput: {
          bg: '#fff',
          text: '#212121'
        },
        userList: {
          bg: '#fff',
          text: '#212121'
        },
      }, // specifies the color scheme for the component
    }
  },
  methods: {
    checkPrefills() {
      const prefill = this.prefills.find(prefill => !prefill.filled);
      if (prefill) {
        this.newMessagesCount = this.isChatOpen ? this.newMessagesCount : this.newMessagesCount + 1
        this.addNewMessage({ author: 'bot', type: 'text', data: { text: prefill.label }, prefill_id: prefill.id, }, false);
      } else {
        this.addNewMessage({
          type: 'text',
          author: 'bot',
          data: {
            text: `Additional questions?`,
          },
          suggestions: [
            'Yes',
            'No',
          ],
          options: {
            generic_followup: true,
          },
        }, false);
      }
    },
    handlePreFills(check_prefill = false) {
      if (this.prefillTimerID) {
        clearTimeout(this.prefillTimerID);
      }
      if (!check_prefill) {
        return
      }
      this.prefillTimerID = setTimeout(() => {
        this.checkPrefills();
      }, this.promptTimeout * 1000)
    },
    receiveMessage (text, question) {
      if (text.length > 0) {
        this.newMessagesCount = this.isChatOpen ? this.newMessagesCount : this.newMessagesCount + 1
        this.addNewMessage({ author: 'bot', type: 'text', data: { text }, need_conversion: true, }, true)

        if (text.startsWith(`Sorry, I don't know that as yet.`)) {
          // this.checkPrefills();
        }
        if (question.data.text.toLowerCase().includes('quote')) {
          this.checkPrefills();
        }
      }
    },
    requireReply (message) {
      this.showTypingIndicator = '...'
      this.$http.post('chatbot/ask', {
        question: message.data.text,
        type: 'embed',
      })
      .then(response => response.data.data)
      .then((data) => {
        const {answer} = data
        this.receiveMessage(answer, message)
      })
      .catch(e => {
        console.log(e);
      })
      .finally(() => {
        this.showTypingIndicator = ''
      })
    },
    addNewMessage (message, check_prefill = false) {
      this.messageList = [ ...this.messageList, message ]
      this.handlePreFills(check_prefill);
    },
    getLasMessage() {
      return this.messageList[this.messageList.length - 1];
    },
    onMessageWasSent (message) {
      if (!this.everTouched) {
        this.everTouched = true;
      }
      if (this.touchWords.some(word => message.data.text.toLowerCase().includes(word))) {
        this.toLead = true;
      }

      const lastMessage = this.getLasMessage();
      if (lastMessage.options && lastMessage.options.generic_followup) {
        if (this.positiveWords.some(word => message.data.text.toLowerCase() == word)) {
          this.addNewMessage(message);
          return;
        }
        if (this.negativeWords.some(word => message.data.text.toLowerCase() == word)) {
          this.addNewMessage(message);
          this.addNewMessage({
            type: 'text',
            author: 'bot',
            data: {
              text: `Thank you, I'm here if you need additional assistance`,
            },
          }, false);
          return;
        }
      }

      // called when the user sends a message
      this.addNewMessage(message);
      
      if (lastMessage.prefill_id) {
        this.prefills.find(prefill => prefill.id == lastMessage.prefill_id).filled = true;
        this.checkPrefills();
        return;
      }
      if (message.author == 'me') {
        this.requireReply(message)
      }
    },
    openChat () {
      // called when the user clicks on the fab button to open the chat
      this.isChatOpen = true
      this.newMessagesCount = 0
    },
    closeChat () {
      // called when the user clicks on the botton to close the chat
      this.isChatOpen = false
    },
    sendLog() {
      if (!this.log.ip) return
      this.log.exit_at = new Date()
      navigator.sendBeacon(`${this.$http.options.root}/chatbot/log`, new Blob([JSON.stringify({
        ip: this.log.ip,
        title: document.title,
        url: location.href,
        enter_at: this.log.enter_at,
        exit_at: this.log.exit_at,
        messages: this.messageList.map(message => ({
          author: message.author,
          text: message.data.text,
        })),
        toLead: this.toLead,
      })], {type: 'text/plain; charset=UTF-8'}))
      this.log.sent = true
    },
    handleSendLog() {
      this.everTouched && !this.log.sent && this.sendLog()
    },
  },
  filters: {
    conversion: function (value, status, message) {
      if (!value) return ''
      if (!message.need_conversion) return value
      if (!status.conversion || !status.conversion.from) return value

      value = value.toString().replaceAll(status.conversion.from, status.conversion.to);

      var from = new RegExp(status.conversion.from, 'g')
      return value.replace(from, status.conversion.to);
    }
  },
  mounted() {
    fetch('https://api.ipify.org?format=json').then(response => response.json()).then(data => {
      this.log.ip = data.ip
    })
    window.addEventListener('unload', this.handleSendLog)
    window.addEventListener('beforeunload', this.handleSendLog)
    this.$http.get('chatbot/status')
      .then((response) => response.body)
      .then((data) => {
        this.status = data;
      });
  },
}
</script>
<style lang="scss">
.sc-launcher {
  z-index: 9999;
}
.sc-chat-window {
  z-index: 9999;
}
.sc-suggestions-row {
  margin-bottom: 6px;
}
.chat-bot-wrapper {
  .sc-message-list {
    padding-bottom: 10px;
  }
}
</style>