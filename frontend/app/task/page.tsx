'use client'

import { NextPage } from 'next'
import { useEffect, useState } from 'react'
import Modal from 'react-modal'
import useSWR from 'swr'

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

const fetcher = async (url: string) => {
  return await fetch(url).then((res) => res.json())
}

const Task: NextPage<TaskProps> = () => {
  const { data, error, isLoading } = useSWR('/test.json', fetcher)
  console.log(data)
  const tasks: Task[] = data.tasks

  const [pendingTask, setPendingTask] = useState<Task[]>([])
  const [inProgressTask, setInProgressTask] = useState<Task[]>([])
  const [completedTask, setCompletedTask] = useState<Task[]>([])
  const [isModalOpen, setIsModalOpen] = useState<boolean>(false)
  const [modalTask, setModalTask] = useState<Task>()
  const handleOpenModal = (taskId: number) => {
    setIsModalOpen(true)
    console.log(taskId)
    setModalTask(tasks.find((task) => task.id === taskId))
  }

  useEffect(() => {
    setPendingTask(tasks.filter((task) => task.status === 1))
    setInProgressTask(tasks.filter((task) => task.status === 2))
    setCompletedTask(tasks.filter((task) => task.status === 3))
  }, [])

  return (
    <>
      <div className="">
        <div className="font-body text-center pt-6 pb-1">
          ダブルクリックで削除!
        </div>
        <div className="flex h-3/5">
          <div className="px-1 w-full task-card">
            <div className="border rounded-lg bg-white shadow-md">
              <div className="py-4">
                <p className="font-body text-2xl text-center pb-3">
                  <i className="fa-solid fa-file-pen"></i>検討中のタスク
                </p>
                <div className="task-index" data-priority-id="0">
                  {pendingTask.map((task) => {
                    return (
                      <div
                        key={task.id}
                        className="task"
                        onClick={() => handleOpenModal(task.id)}
                      >
                        <div className="hover:cursor-pointer mx-3 my-1 p-2 border rounded-md active:bg-gray-100 shadow">
                          <div className="flex justify-between">
                            <p className="text-lg">{task.title}</p>
                          </div>
                          <p className="hidden whitespace-pre-wrap text-sm mx-3 my-1 p-1">
                            {task.contents}
                          </p>
                          <p className="hidden whitespace-pre-wrap text-xs text-right text-gray-400 mx-3 my-1 p-1">
                            ({task.minutes}分)
                          </p>
                        </div>
                      </div>
                    )
                  })}
                </div>
              </div>
            </div>
          </div>
          <div className="px-1 w-full task-card">
            <div className="border rounded-lg bg-white shadow-md">
              <div className="py-4">
                <p className="font-body text-2xl text-center pb-3">
                  <i className="fa-regular fa-circle-dot"></i>実行中のタスク
                </p>
                <div className="task-index" data-priority-id="1">
                  {inProgressTask.map((task) => {
                    return (
                      <div
                        key={task.id}
                        className="task"
                        onClick={() => handleOpenModal(task.id)}
                      >
                        <div className="hover:cursor-pointer mx-3 my-1 p-2 border rounded-md active:bg-gray-100 shadow">
                          <div className="flex justify-between">
                            <p className="text-lg">{task.title}</p>
                          </div>
                          <p className="hidden whitespace-pre-wrap text-sm mx-3 my-1 p-1">
                            {task.contents}
                          </p>
                          <p className="hidden whitespace-pre-wrap text-xs text-right text-gray-400 mx-3 my-1 p-1">
                            ({task.minutes}分)
                          </p>
                        </div>
                      </div>
                    )
                  })}
                </div>
              </div>
            </div>
          </div>
          <div className="px-1 w-full task-card">
            <div className="border rounded-lg bg-white shadow-md">
              <div className="py-4">
                <p className="font-body text-2xl text-center pb-3">
                  <i className="fa-solid fa-check"></i>完了したタスク
                </p>
                <div className="task-index" data-priority-id="2">
                  {completedTask.map((task) => {
                    return (
                      <div
                        key={task.id}
                        className="task"
                        onClick={() => handleOpenModal(task.id)}
                      >
                        <div className="hover:cursor-pointer mx-3 my-1 p-2 border rounded-md active:bg-gray-100 shadow">
                          <div className="flex justify-between">
                            <p className="text-lg">{task.title}</p>
                            <button type="button"></button>
                          </div>
                          <p className="hidden whitespace-pre-wrap text-sm mx-3 my-1 p-1">
                            {task.contents}
                          </p>
                          <p className="hidden whitespace-pre-wrap text-xs text-right text-gray-400 mx-3 my-1 p-1">
                            ({task.minutes}分)
                          </p>
                        </div>
                      </div>
                    )
                  })}
                </div>
              </div>
            </div>
          </div>
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
              />
              <input
                type="text"
                className="py-2 focus:border-1 focus:border-blue-100"
                value={modalTask.contents}
              />
              <input
                type="text"
                className="py-2 focus:border-1 focus:border-blue-100"
                value={modalTask.minutes}
              />
              <input
                type="text"
                className="py-2 focus:border-1 focus:border-blue-100"
                value={modalTask.status}
              />
            </div>
          )}
        </Modal>
      </div>
    </>
  )
}

export default Task
