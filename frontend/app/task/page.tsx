'use client'

import { NextPage } from 'next'
import { useEffect, useState } from 'react'

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
  const tasks: Task[] = [
    {
      id: 1,
      title: 'sample title1',
      contents: 'sample contents',
      minutes: 1,
      status: 1,
    },
    {
      id: 1,
      title: 'sample title2',
      contents: 'sample contents',
      minutes: 1,
      status: 2,
    },
    {
      id: 1,
      title: 'sample title3',
      contents: 'sample contents',
      minutes: 1,
      status: 3,
    },
  ]

  const [pendingTask, setPendingTask] = useState<Task[]>([])
  const [inProgressTask, setInProgressTask] = useState<Task[]>([])
  const [completedTask, setCompletedTask] = useState<Task[]>([])

  useEffect(() => {
    setPendingTask(tasks.filter((task) => task.status === 1))
    setInProgressTask(tasks.filter((task) => task.status === 2))
    setCompletedTask(tasks.filter((task) => task.status === 3))
  })

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
                      <div className="task" data-taskId={task.id}>
                        <div className="hover:cursor-pointer mx-3 my-1 p-2 border rounded-md active:bg-gray-100 shadow">
                          <div className="flex justify-between">
                            <p className="text-lg">{task.title}</p>
                            <button
                              type="button"
                              data-modal-toggle="authentication-edit-modal"
                            >
                              <i
                                className="fa-solid fa-pen-to-square hover:bg-gray-300 edit-task"
                                data-task-title={task.title}
                                data-task-contents={task.contents}
                                data-task-timer={task.minutes}
                                data-tasks-id={task.id}
                              ></i>
                            </button>
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

                {/* pending */}
                {/* <x-task-modal-thinking /> */}
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
                      <div className="task" data-taskId={task.id}>
                        <div className="hover:cursor-pointer mx-3 my-1 p-2 border rounded-md active:bg-gray-100 shadow">
                          <div className="flex justify-between">
                            <p className="text-lg">{task.title}</p>
                            <button
                              type="button"
                              data-modal-toggle="authentication-edit-modal"
                            >
                              <i
                                className="fa-solid fa-pen-to-square hover:bg-gray-300 edit-task"
                                data-task-title={task.title}
                                data-task-contents={task.contents}
                                data-task-timer={task.minutes}
                                data-tasks-id={task.id}
                              ></i>
                            </button>
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

                {/* in_progress */}
                {/* <x-task-modal-doing /> */}
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
                      <div className="task" data-taskId={task.id}>
                        <div className="hover:cursor-pointer mx-3 my-1 p-2 border rounded-md active:bg-gray-100 shadow">
                          <div className="flex justify-between">
                            <p className="text-lg">{task.title}</p>
                            <button
                              type="button"
                              data-modal-toggle="authentication-edit-modal"
                            >
                              <i
                                className="fa-solid fa-pen-to-square hover:bg-gray-300 edit-task"
                                data-task-title={task.title}
                                data-task-contents={task.contents}
                                data-task-timer={task.minutes}
                                data-tasks-id={task.id}
                              ></i>
                            </button>
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

                {/* completed */}
                {/* <x-task-modal-done /> */}
              </div>
            </div>
          </div>
        </div>

        {/* <x-task-modal-edit /> */}

        {/* <!-- loading --> */}
        <div className="load-icon text-center hidden">
          <i className="fas fa-spinner fa-pulse"></i>
        </div>
      </div>
    </>
  )
}

export default Task
