'use client'

import { useClockStart } from '@/features/home/hooks/useClockStart'
import { useClockStop } from '@/features/home/hooks/useClockStop'
import { Task } from '@/features/home/types'
import { formatClock } from '@/features/home/utils'
import React, { useEffect, useRef, useState } from 'react'

type ClockProps = {
  tasks: Task[]
}

const Clock = ({ tasks }: ClockProps) => {
  const [isRunning, setIsRunning] = useState<boolean>(false)
  const [seconds, setSeconds] = useState<number>(0)
  const amount = useRef(0)
  const intervalId = useRef<NodeJS.Timeout>()
  const deg = useRef<number>(360)
  const styleRotate = useRef<React.CSSProperties>({
    rotate: '0',
  })
  const [currentTask, setCurrentTask] = useState<Task>()

  const handleClockStart = () => {
    if (currentTask === undefined) {
      return
    }

    useClockStart(
      currentTask,
      intervalId,
      amount,
      styleRotate,
      deg,
      setIsRunning,
      setSeconds,
    )
  }

  const handleClockStop = () => {
    useClockStop(intervalId, setIsRunning)
  }

  useEffect(() => {
    if (tasks.length > 0) {
      setCurrentTask(tasks[0])
      setSeconds(tasks[0].minutes * 60)
      amount.current = tasks[0].minutes * 60
    }
  }, [])

  return (
    <>
      {/* タイマー */}
      <div className="grow">
        <div className="flex justify-center pt-12">
          <div
            className="transform h-96 w-96 border-8 rounded-full flex justify-center items-center bg-white relative"
            style={styleRotate.current}
          >
            <div className="absolute -top-6 border rounded-full bg-gray-400 w-12 h-12"></div>
          </div>
          {tasks.length > 0 ? (
            <p className="text-6xl absolute top-72">{formatClock(seconds)}</p>
          ) : (
            <p className="text-6xl absolute top-72 font-medium font-body">
              タスクが登録されていません
            </p>
          )}

          <div className="hidden justify-center my-20">
            <div className="animate-ping h-4 w-4 bg-blue-600 rounded-full"></div>
          </div>
        </div>

        <div className="text-center text-2xl font-bold pt-12">
          {tasks.length > 0 ? (
            <>
              <p className="text-center text-2xl font-bold" id="task-title">
                {tasks[0].title}
              </p>
              <span className="hidden"></span>
            </>
          ) : (
            <div className="flex flex-col items-center">
              <i className="fa-solid fa-arrow-down animate-bounce text-lg"></i>
              <a
                href="/tasks"
                className="font-body text-2xl text-gray-600 hover:underline"
              >
                タスクを登録する？
              </a>
            </div>
          )}
        </div>

        <div className="flex justify-center pt-12">
          <button
            className="text-white rounded px-3 py-2 bg-blue-600 active:bg-blue-900"
            onClick={isRunning ? handleClockStop : handleClockStart}
          >
            {isRunning ? 'stop' : 'start'}
          </button>
        </div>
      </div>
    </>
  )
}

export default Clock
