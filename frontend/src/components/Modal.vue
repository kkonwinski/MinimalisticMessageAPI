<template>
  <div>
    <h1>{{ message.message }}</h1>
    <p>{{ message.createdAt }}</p>
    <button @click="$emit('close')">Close</button>
  </div>
</template>

<script>
export default {
  props: ['message']
}
</script>
