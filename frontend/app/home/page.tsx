import { NextPage } from 'next'

const Home: NextPage = () => {
  const tasks = [
    {
      id: 1,
      timer: 10,
      title: 'test',
      contents: 'contents sample',
    },
  ]
  return (
    <div className="flex">
      {/* タイマー */}
      <div className="grow">
        <div className="flex justify-center pt-12">
          <div
            id="spin"
            className="h-96 w-96 border border-8 rounded-full flex justify-center items-center bg-white relative"
          >
            <div className="absolute -top-6 border rounded-full bg-gray-400 w-12 h-12"></div>
          </div>
          {tasks.length > 0 ? (
            <p
              id="timer-display"
              className="text-6xl absolute top-72"
              data-timer-amount={tasks[0].timer * 60}
            >
              {tasks[0].timer + '00:00'}
            </p>
          ) : (
            <p
              id="timer-display"
              className="text-6xl absolute top-72 font-medium font-body"
              data-timer-amount="0"
            >
              タスクが登録されていません
            </p>
          )}

          <div id="finish-icon" className="flex justify-center my-20 hidden">
            <div className="animate-ping h-4 w-4 bg-blue-600 rounded-full"></div>
          </div>
        </div>

        <div className="text-center text-2xl font-bold pt-12">
          {tasks.length > 0 ? (
            <>
              <p className="text-center text-2xl font-bold" id="task-title">
                {tasks[0].title}
              </p>
              <span
                className="hidden"
                id="n-exec-increment"
                data-tasks-id-increment={tasks[0].id}
              ></span>
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
            id="start-button"
            className="text-white rounded px-3 py-2 bg-blue-600 active:bg-blue-900"
          >
            start
          </button>
          <button
            id="stop-button"
            className="hidden text-white rounded px-3 py-2 bg-pink-600 active:bg-pink-900"
          >
            stop
          </button>
        </div>
      </div>

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
