<template>
  <div>
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
      title="SixAxis Support"
      disableUserListToggle
    >
      <template v-slot:user-avatar="{}">
        <div></div>
      </template>
    </beautiful-chat>
  </div>
</template>

<script>
export default {
  data() {
    return {
      participants: [
        {
          id: 'bot',
          name: 'Support',
        },
      ], // the list of all the participant of the conversation. `name` is the user name, `id` is used to establish the author of a message, `imageUrl` is supposed to be the user avatar.
      messageList: [
      ], // the list of the messages to show, can be paginated and adjusted dynamically
      newMessagesCount: 0,
      isChatOpen: false, // to determine whether the chat window should be open or closed
      showTypingIndicator: '', // when set to a value matching the participant.id it shows the typing indicator for the specific user
      colors: {
        header: {
          bg: '#D32F2F',
          text: '#fff'
        },
        launcher: {
          bg: '#D32F2F'
        },
        messageList: {
          bg: '#fff'
        },
        sentMessage: {
          bg: '#F44336',
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
    sendMessage (text) {
      if (text.length > 0) {
        this.newMessagesCount = this.isChatOpen ? this.newMessagesCount : this.newMessagesCount + 1
        this.onMessageWasSent({ author: 'me', type: 'text', data: { text } })
      }
    },
    onMessageWasSent (message) {
      // called when the user sends a message
      this.messageList = [ ...this.messageList, message ]
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
  },
  mounted() {
  },
}
</script>
<style lang="scss" scoped>
</style>