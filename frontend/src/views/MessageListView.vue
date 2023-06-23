<template>
  <div>
    <div class="my-3 d-flex justify-content-end">
      <router-link to="/send-message">
        <button type="button" class="btn btn-outline-primary">Send New Message</button>
      </router-link>
    </div>
    <div class="d-flex justify-content-end">
      <div class="px-4">
        <button @click="sortMessages('uuid')" class="btn btn-warning">
          {{ sortUuidText }}
        </button>
      </div>
      <div>
        <button @click="sortMessages('date')" class="btn btn-success">
          {{ sortDateText }}
        </button>
      </div>
    </div>
    <div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Message</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="message in messages" :key="message.uuid">
            <td>{{ message.id }}</td>
            <td>{{ trimMessage(message.message) }}</td>
            <td>
              <button class="btn btn-primary" @click="openModal(message)">
                Show
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <Modal
        v-if="modalOpen"
        :message="selectedMessage"
        @close="modalOpen = false"
      />
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Modal from "../components/Modal.vue";

export default {
  components: {
    Modal,
  },
  data() {
    return {
      messages: [],
      modalOpen: false,
      selectedMessage: null,
      sortUuid: null,
      sortDate: null,
      uuidClicks: 0,
      dateClicks: 0,
    };
  },
  computed: {
    sortUuidText() {
      return this.uuidClicks === 0
        ? "Sort by UUID"
        : this.sortUuid === "asc"
        ? "Sort by UUID Descending"
        : "Remove UUID filter";
    },
    sortDateText() {
      return this.dateClicks === 0
        ? "Sort by Date"
        : this.sortDate === "asc"
        ? "Sort by Date Descending"
        : "Remove Date filter";
    },
  },
  methods: {
    async fetchMessages(orderByUuid = null, orderByDate = null) {
      let url = "http://0.0.0.0:8080/api/message/list";
      if (orderByUuid || orderByDate) {
        url += "?";
        if (orderByUuid) url += `orderByUuid=${orderByUuid}`;
        if (orderByDate) {
          if (orderByUuid) url += "&";
          url += `orderByDate=${orderByDate}`;
        }
      }
      console.log(url);
      const response = await axios.get(url);
      this.messages = response.data;
    },
    trimMessage(message) {
      const words = message.split(" ");
      if (words.length > 200) {
        return words.slice(0, 100).join(" ") + "...";
      } else {
        return message;
      }
    },
    sortMessages(orderByField) {
      if (orderByField === "uuid") {
        this.uuidClicks++;
        if (this.uuidClicks === 3) {
          this.sortUuid = null;
          this.uuidClicks = 0;
        } else {
          this.sortUuid = this.sortUuid === "asc" ? "desc" : "asc";
        }
      } else {
        this.dateClicks++;
        if (this.dateClicks === 3) {
          this.sortDate = null;
          this.dateClicks = 0;
        } else {
          this.sortDate = this.sortDate === "asc" ? "desc" : "asc";
        }
      }
      this.fetchMessages(this.sortUuid, this.sortDate);
    },
    openModal(message) {
      this.selectedMessage = message;
      this.modalOpen = true;
    },
  },
  mounted() {
    this.fetchMessages();
  },
};
</script>
