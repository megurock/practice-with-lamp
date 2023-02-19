<script setup lang="ts">
import Reservation from '@/components/pages/Reservation.vue'
import { ref } from 'vue'

const name = ref('')
const email = ref('')
const date = ref('')
</script>

<template>
  <Reservation v-model:name="name" v-model:email="email" v-model:date="date" />
</template>

<style lang="scss"></style>
