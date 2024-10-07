'use client'

import Clock from '@/features/home/components/Clock'
import { TaskList } from '@/features/home/components/TaskIist'
import { useTasks } from '@/features/home/hooks/useTasks'
import { NextPage } from 'next'

const HomePage: NextPage = () => {
  const { data, isLoading } = useTasks()
  const tasks = data ?? []

  return (
    <div className="flex">
      {!isLoading && (
        <>
          <Clock tasks={tasks} />
          <TaskList tasks={tasks} />
        </>
      )}
    </div>
  )
}

export default HomePage
