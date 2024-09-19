import { Task } from '@/features/task/types'
import React from 'react'
import Modal from 'react-modal'

type Props = {
  isOpen: boolean
  setIsModalOpen: React.Dispatch<React.SetStateAction<boolean>>
  task: Task
}

export const TaskModal = ({ isOpen, setIsModalOpen, task }: Props) => {
  return (
    <Modal
      isOpen={isOpen}
      onRequestClose={() => setIsModalOpen(false)}
      ariaHideApp={false}
    >
      {task && (
        <div className="flex flex-col">
          <input
            type="text"
            className="py-2 focus:border-1 focus:border-blue-100"
            value={task.id}
            readOnly
          />
          <input
            type="text"
            className="py-2 focus:border-1 focus:border-blue-100"
            value={task.title}
            readOnly
          />
          <input
            type="text"
            className="py-2 focus:border-1 focus:border-blue-100"
            value={task.contents}
            readOnly
          />
          <input
            type="text"
            className="py-2 focus:border-1 focus:border-blue-100"
            value={task.minutes}
            readOnly
          />
          <input
            type="text"
            className="py-2 focus:border-1 focus:border-blue-100"
            value={task.status}
            readOnly
          />
        </div>
      )}
    </Modal>
  )
}
