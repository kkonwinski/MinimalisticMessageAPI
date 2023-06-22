<template>
  <div
    class="modal fade show"
    tabindex="-1"
    style="display: block; padding-right: 17px"
  >
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content" style="cursor: auto">
        <div class="modal-header">
          <h5 class="modal-title">Message: {{ message.uuid }}</h5>
          <button
            type="button"
            class="btn-close"
            @click="$emit('close')"
          ></button>
        </div>
        <div class="modal-body">
          <p>{{ message.message }}</p>
          <p>{{ message.createdAt }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["message"],
};
</script>
