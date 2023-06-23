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
        if (!this.content || this.content.length > 2500) {
          throw new Error("Invalid content length");
        }
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
        this.alert.message = error.message || "We can't send message, try send message later";
      }
    },
  },
};
</script>
