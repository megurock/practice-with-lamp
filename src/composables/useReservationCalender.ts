const localeDateToCalenderDate = (localeDate: string) => {
  return localeDate
    .split('/')
    .reduce((list: string[], value) => list.concat(value.padStart(2, '0')), [])
    .join('-')
}

const getDaysInMonth = (year: number, month: number) => {
  return new Date(year, month + 1, 0)
}

export function useReservationCalender() {
  const today = new Date()
  const theYear = today.getFullYear()
  const theMonth = today.getMonth()
  const tomorrow = new Date(theYear, theMonth, today.getDate() + 1)
  const lastDayOfNextMonth = getDaysInMonth(theYear, theMonth + 1)
  return {
    minDate: localeDateToCalenderDate(tomorrow.toLocaleDateString()),
    maxDate: localeDateToCalenderDate(lastDayOfNextMonth.toLocaleDateString()),
  }
}
