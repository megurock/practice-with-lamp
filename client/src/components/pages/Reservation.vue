<script setup lang="ts">
import { reactive } from 'vue'
import { useReservationCalender } from '@/composables/useReservationCalender'
import { useValidateReservation } from '@/composables/useValidateReservation'
import { useFetch } from '@/composables/useFetch'

export interface Props {
  name: string
  email: string
  date: string
}

interface Emits {
  (event: 'update:name', value: string): void
  (event: 'update:email', value: string): void
  (event: 'update:date', value: string): void
}

interface Result {
  status: 'success' | 'fail' | 'error'
  dates: string[]
}

const props = defineProps<Props>()
const emit = defineEmits<Emits>()
const { isValidName, isNameError, isValidEmail, isEmailError, hasDate, canSubmit } = useValidateReservation(props)
const { minDate, maxDate } = useReservationCalender()
const { data, exec } = useFetch<Result>()

const onSubmit = () => {
  const { name, email, date } = props
  const params = `name=${name}&email=${email}&date=${date}`
  const url = `${import.meta.env.VITE_API_BASE_PATH}/addBooking.php?${params}`
  exec(url)
}
</script>

<template>
  <form novalidate class="reservation-form" @submit.prevent="onSubmit">
    <p>{{ data?.status }}</p>
    <p>{{ data?.dates }}</p>
    <div class="form-item">
      <input
        type="text"
        maxlength="25"
        :class="{ 'invalid-input': isNameError, 'valid-input': isValidName }"
        :value="name"
        autocomplete="name"
        @input="emit('update:name', ($event.target as HTMLInputElement).value ?? '')"
        placeholder="Your name"
      />
    </div>
    <div class="form-item">
      <input
        type="email"
        :class="{ 'invalid-input': isEmailError, 'valid-input': isValidEmail }"
        :value="email"
        autocomplete="email"
        @input="emit('update:email', ($event.target as HTMLInputElement).value ?? '')"
        placeholder="E-mail"
      />
    </div>
    <div class="form-item">
      <input
        type="date"
        :min="minDate"
        :max="maxDate"
        :class="{ 'valid-input': hasDate }"
        :value="date"
        @input="emit('update:date', ($event.target as HTMLInputElement).value ?? '')"
      />
    </div>
    <div style="text-align: right">
      <button type="submit" :disabled="!canSubmit">Submit</button>
    </div>
  </form>
</template>

<style lang="scss" scoped>
.reservation-form {
  display: flex;
  flex-direction: column;
  gap: 1.5rem 0;
  > * {
    width: 100%;
  }
}

.valid-input {
  border-color: lightgreen;
}
.invalid-input {
  border-color: red;
}
</style>
