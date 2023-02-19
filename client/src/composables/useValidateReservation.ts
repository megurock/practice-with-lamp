import { computed } from 'vue'
import { Props } from '@/components/pages/Reservation.vue'

export function useValidateReservation<T>(props: Props) {
  // Name
  const hasName = computed(() => /\S+/.test(props.name))
  const isValidName = computed(() => props.name.length >= 3)
  const isNameError = computed(() => hasName.value && !isValidName.value)

  // Email
  const hasEmail = computed(() => /\S+/.test(props.email))
  const isValidEmail = computed(() =>
    /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]+.[A-Za-z0-9]+$/.test(props.email),
  )
  const isEmailError = computed(() => hasEmail.value && !isValidEmail.value)

  // Date
  const hasDate = computed(() => /\S+/.test(props.date))

  // Form validation
  const canSubmit = computed(() => !isNameError.value && !isEmailError.value && hasDate.value)

  return {
    isValidName,
    isNameError,
    isValidEmail,
    isEmailError,
    hasDate,
    canSubmit,
  }
}
