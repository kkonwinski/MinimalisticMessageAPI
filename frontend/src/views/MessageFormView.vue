<template>
  <form @submit.prevent="send" class="my-3">
    <div class="mb-3">
      <textarea
        class="form-control"
        v-model="content"
        placeholder="Message content"
        required
      ></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Send</button>
  </form>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      content: "",
    };
  },
  methods: {
    async send() {
      const message = {
        message: this.content,
      };
      await axios.post("http://0.0.0.0:8080/api/message/add", message);
      this.content = "";
    },
  },
};
</script>
