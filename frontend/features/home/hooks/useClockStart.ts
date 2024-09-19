import { Task } from '@/features/home/types/types'
import React from 'react'

export const useClockStart = (
  currentTask: Task,
  intervalId: React.MutableRefObject<NodeJS.Timeout | undefined>,
  amount: React.MutableRefObject<number>,
  styleRotate: React.MutableRefObject<React.CSSProperties>,
  deg: React.MutableRefObject<number>,
  setIsRunning: React.Dispatch<React.SetStateAction<boolean>>,
  setSeconds: React.Dispatch<React.SetStateAction<number>>,
) => {
  setIsRunning(true)

  intervalId.current = setInterval(function () {
    setSeconds((seconds) => seconds - 1)
    amount.current += -1
    deg.current = (1 - amount.current / (currentTask.minutes * 60)) * 360
    styleRotate.current = {
      rotate: deg.current + 'deg',
    }

    if (amount.current <= 0) {
      clearInterval(intervalId.current)
      setIsRunning(false)
    }
  }, 1000)
}
