import Clock from '@/features/home/Clock'
import { NextPage } from 'next'

const Home: NextPage = () => {
  const tasks = [
    {
      id: 1,
      minutes: 0.2,
      title: 'test',
      contents: 'contents sample',
    },
  ]
  return (
    <div className="flex">
      <Clock tasks={tasks} />

      {/* Task一覧 */}
      <div className="border bg-white rounded-lg p-6 m-3 h-80 w-96 overflow-y-scroll">
        <p className="font-bold text-2xl pb-6">タスクの指定</p>
        <ul>
          {tasks.map((task) => {
            return (
              <>
                <li
                  className="hover:underline hover:text-gray-400 cursor-pointer pb-2 set-timer"
                  data-tasks-id="{{ $item->tasks_id }}"
                >
                  {task.title}
                </li>
                <li className="hidden">{task.contents}</li>
              </>
            )
          })}
        </ul>
      </div>
    </div>
  )
}

export default Home
