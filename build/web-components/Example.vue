<template>
  <div>
    <p>{{ message }}</p>
    <input type="text" v-model="message" />
  </div>
</template>
<script>
export default {
  data () {
    return {
      message: ''
    }
  }
}
</script>
