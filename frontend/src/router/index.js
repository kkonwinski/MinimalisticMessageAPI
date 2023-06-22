import { createRouter, createWebHistory } from "vue-router";
import MessageListView from "../views/MessageListView.vue";
import MessageFormView from "../views/MessageFormView.vue";
// import MessageDetailView from '../views/MessageDetailView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/messages",
      name: "messages",
      component: MessageListView,
    },
    {
      path: "/add-message",
      name: "add-message",
      component: MessageFormView,
    },
    // {
    //   path: '/message/:id',
    //   name: 'message-detail',
    //   component: MessageDetailView,
    //   props: true
    // }
  ],
});

export default router;
