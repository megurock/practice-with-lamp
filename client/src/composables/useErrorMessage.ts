import { computed } from 'vue'

export function useErrorMessage(getStatus: () => string, getDates: () => string[]) {
  const errorMessage = computed(() => {
    switch (getStatus()) {
      case 'error':
        return 'Oops, something wrong!'
      case 'fail':
        const message = 'Failed to book.'
        return getDates().length >= 3 ? `${message} You can book up to three.` : message
    }
  })

  return { errorMessage }
}
