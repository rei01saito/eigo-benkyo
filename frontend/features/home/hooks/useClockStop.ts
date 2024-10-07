import React from 'react'

export const useClockStop = (
  intervalId: React.MutableRefObject<NodeJS.Timeout | undefined>,
  setIsRunning: React.Dispatch<React.SetStateAction<boolean>>,
) => {
  clearInterval(intervalId.current)
  setIsRunning(false)
}
