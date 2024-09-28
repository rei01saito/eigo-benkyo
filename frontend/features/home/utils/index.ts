export const formatClock = (seconds: number): string => {
  const clockMinutes = String(Math.floor(seconds / 60)).padStart(2, '0')
  const clockSeconds = String(seconds % 60).padStart(2, '0')
  return clockMinutes + ':' + clockSeconds
}
