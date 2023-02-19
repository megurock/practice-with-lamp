import { ref } from 'vue'

export function useFetch<T>(url: RequestInfo | URL, options?: RequestInit) {
  const data = ref<T | null>(null)
  const error = ref<Error | null>(null)
  const isPending = ref(true)

  fetch(url, options)
    .then(res => res.json())
    .then(_data => (data.value = _data))
    .catch(_error => (error.value = _error))
    .finally(() => (isPending.value = false))

  return {
    data,
    error,
    isPending,
  }
}
