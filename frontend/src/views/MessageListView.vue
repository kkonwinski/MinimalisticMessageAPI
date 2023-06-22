<template>
  <div>
    <button @click="sortMessages">Sort</button>
    <ul>
      <li v-for="message in messages" :key="message.uuid" @click="openModal(message)">
        {{ message.message }}
      </li>
    </ul>
    <Modal v-if="modalOpen" :message="selectedMessage" @close="modalOpen = false" />
  </div>
</template>

<script>
import axios from 'axios'
import Modal from '../components/Modal.vue'

export default {
  components: {
    Modal
  },
  data() {
    return {
      messages: [],
      modalOpen: false,
      selectedMessage: null
    }
  },
  methods: {
    async fetchMessages() {
      const response = await axios.get('http://0.0.0.0:8080/api/messages')
      this.messages = response.data
    },
    sortMessages() {
      this.messages.sort((a, b) => a.createdAt.localeCompare(b.createdAt))
    },
    openModal(message) {
      this.selectedMessage = message
      this.modalOpen = true
    }
  },
  mounted() {
    this.fetchMessages()
  }
}
</script>
