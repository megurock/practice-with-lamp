import { ref } from 'vue'

export function useFetch<T>() {
  const data = ref<T | null>(null)
  const error = ref<Error | null>(null)
  const isPending = ref(true)

  const exec = (url: RequestInfo | URL, options?: RequestInit) =>
    fetch(url, options)
      .then(res => res.json())
      .then(_data => (data.value = _data))
      .catch(_error => (error.value = _error))
      .finally(() => (isPending.value = false))

  return {
    exec,
    data,
    error,
    isPending,
  }
}
