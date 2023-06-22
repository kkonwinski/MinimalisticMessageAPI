<template>
  <form @submit.prevent="send">
    <textarea v-model="content" placeholder="Message content" required></textarea>
    <button type="submit">Send</button>
  </form>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      content: ''
    }
  },
  methods: {
    async send() {
      const message = {
        message: this.content
      }
      await axios.post('http://0.0.0.0:8080/api/message/add', message)
      this.content = ''
    }
  }
}
</script>
