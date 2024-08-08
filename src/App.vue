<template>
  <whats-scheduler/>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component';
import WhatsScheduler from '@/components/WhatsScheduler.vue'

@Options({
  components: {
    WhatsScheduler,
  },
})
export default class App extends Vue {}
</script>

<style lang="scss">

</style>
