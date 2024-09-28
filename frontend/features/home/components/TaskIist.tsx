import { Task } from '@/features/home/types'
import React from 'react'

type Props = {
  tasks: Task[]
}

export const TaskList = ({ tasks }: Props) => {
  return (
    <div className="border bg-white rounded-lg p-6 m-3 h-80 w-96 overflow-y-scroll scroller shadow">
      <p className="font-bold text-2xl pb-6">タスクの指定</p>
      <ul>
        {tasks.map((task, index) => {
          return (
            <React.Fragment key={index}>
              <li className="hover:underline hover:text-gray-400 cursor-pointer pb-2 set-timer">
                {task.title}
              </li>
              <li className="hidden">{task.contents}</li>
            </React.Fragment>
          )
        })}
      </ul>
    </div>
  )
}
