import { Task } from '@/features/task/types'

type Props = {
  tasks: Task[]
  title: string
  handleClick: (id: number) => void
}

export const TaskCard = ({ tasks, title, handleClick }: Props) => {
  return (
    <div className="px-1 w-full">
      <div className="border rounded-lg bg-white shadow-md">
        <div className="py-4">
          <p className="font-body text-2xl text-center pb-3">
            <i className="fa-solid fa-file-pen"></i>
            {title}
          </p>
          <div data-priority-id="0">
            {tasks.map((task) => {
              return (
                <div key={task.id} onClick={() => handleClick(task.id)}>
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
  )
}

export default TaskCard
