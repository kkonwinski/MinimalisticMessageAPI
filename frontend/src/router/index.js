import { createRouter, createWebHistory } from 'vue-router'
import MessageListView from '../views/MessageListView.vue'
import MessageFormView from '../views/MessageFormView.vue'

const routes = [
  {
    path: '/message-list',
    name: 'MessageList',
    component: MessageListView
  },
  {
    path: '/send-message',
    name: 'SendMessage',
    component: MessageFormView
  }
]

const router = createRouter({
  history: createWebHistory('/'),
  routes
})

export default router
