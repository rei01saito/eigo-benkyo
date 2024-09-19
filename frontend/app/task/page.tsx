'use client'

import { fetchTasks } from '@/features/task/api/fetchTasks'
import TaskCard from '@/features/task/components/TaskCard'
import { NextPage } from 'next'
import { useEffect, useState } from 'react'
import Modal from 'react-modal'

type Task = {
  id: number
  title: string
  contents: string
  minutes: number
  status: number
}

type TaskProps = {
  tasks: Task[]
}

const Task: NextPage<TaskProps> = () => {
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

        <Modal
          isOpen={isModalOpen}
          onRequestClose={() => setIsModalOpen(false)}
          ariaHideApp={false}
        >
          {modalTask && (
            <div className="flex flex-col">
              <input
                type="text"
                className="py-2 focus:border-1 focus:border-blue-100"
                value={modalTask.id}
                readOnly
              />
              <input
                type="text"
                className="py-2 focus:border-1 focus:border-blue-100"
                value={modalTask.title}
                readOnly
              />
              <input
                type="text"
                className="py-2 focus:border-1 focus:border-blue-100"
                value={modalTask.contents}
                readOnly
              />
              <input
                type="text"
                className="py-2 focus:border-1 focus:border-blue-100"
                value={modalTask.minutes}
                readOnly
              />
              <input
                type="text"
                className="py-2 focus:border-1 focus:border-blue-100"
                value={modalTask.status}
                readOnly
              />
            </div>
          )}
        </Modal>
      </div>
    </>
  )
}

export default Task
