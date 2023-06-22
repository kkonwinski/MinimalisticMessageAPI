<template>
  <div>
    <div v-if="alert.show" :class="`alert alert-${alert.type}`" role="alert">
      {{ alert.message }}
    </div>
    <form @submit.prevent="send" novalidate class="my-3">
      <div class="mb-3">
        <textarea
            class="form-control"
            v-model="content"
            placeholder="Message content"
        ></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Send</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      content: "",
      alert: {
        show: false,
        type: "",
        message: "",
      },
    };
  },
  methods: {
    async send() {
      try {
        const formData = new FormData();
        formData.append('message', this.content);
        const response = await axios.post("http://0.0.0.0:8080/api/message/add", formData);
        if (response.status === 201) {
          this.alert.show = true;
          this.alert.type = "success";
          this.alert.message = "Message sent successfully! Uuid: " + response.data.message;
        } else {
          throw new Error();
        }
        this.content = "";
      } catch (error) {
        this.alert.show = true;
        this.alert.type = "danger";
        if (error.response && error.response.data.message) {
          this.alert.message = error.response.data.message.join(' ');
        } else {
          this.alert.message = "An error occurred while sending the message.";
        }
      }
    },
  },
};
</script>
