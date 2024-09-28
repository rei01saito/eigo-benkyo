'use client'

import { fetchTasks } from '@/features/task/api/fetchTasks'
import TaskCard from '@/features/task/components/TaskCard'
import { TaskModal } from '@/features/task/components/TaskModal'
import { Task } from '@/features/task/types'
import { NextPage } from 'next'
import { useEffect, useState } from 'react'

type TaskProps = {
  tasks: Task[]
}

const TaskPage: NextPage<TaskProps> = () => {
  const data = fetchTasks()
  const [tasks, setTasks] = useState<Task[]>([])
  const [pendingTask, setPendingTask] = useState<Task[]>([])
  const [inProgressTask, setInProgressTask] = useState<Task[]>([])
  const [completedTask, setCompletedTask] = useState<Task[]>([])
  const [isModalOpen, setIsModalOpen] = useState<boolean>(false)
  const [modalTask, setModalTask] = useState<Task>()
  const handleOpenModal = (taskId: number) => {
    setIsModalOpen(true)
    setModalTask(tasks.find((task) => task.id === taskId))
  }

  useEffect(() => {
    setTasks(data)
    setPendingTask(tasks.filter((task) => task.status === 1))
    setInProgressTask(tasks.filter((task) => task.status === 2))
    setCompletedTask(tasks.filter((task) => task.status === 3))
  }, [data, tasks])

  return (
    <>
      <div>
        <div className="font-body text-center pt-6 pb-1">
          ダブルクリックで削除!
        </div>

        <div className="flex h-3/5">
          <TaskCard
            title="Pending"
            tasks={pendingTask}
            handleClick={handleOpenModal}
          />

          <TaskCard
            title="In progress"
            tasks={inProgressTask}
            handleClick={handleOpenModal}
          />

          <TaskCard
            title="Completed"
            tasks={completedTask}
            handleClick={handleOpenModal}
          />
        </div>

        {modalTask && (
          <TaskModal
            isOpen={isModalOpen}
            setIsModalOpen={setIsModalOpen}
            task={modalTask}
          />
        )}
      </div>
    </>
  )
}

export default TaskPage
