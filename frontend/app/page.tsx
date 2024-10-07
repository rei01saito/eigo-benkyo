'use client'

import Link from 'next/link'

export default function Top() {
  const handleClick = async () => {
    const data = await fetch('http://localhost:80/api/test').then((data) =>
      data.json(),
    )
    alert(data)
  }

  return (
    <main>
      <h1 className="text-red-500">Hello world</h1>
      <button onClick={handleClick}>click</button>
      <div className="flex">
        <div className="grow">
          <div className="flex justify-center pt-12">
            <div className="blur h-96 w-96 border-8 rounded-full flex justify-center items-center bg-white relative">
              <div className="absolute -top-6 border rounded-full bg-gray-400 w-12 h-12"></div>
            </div>
            <p className="text-6xl absolute top-72 font-semibold font-body">
              タスク管理アプリケーション Katask
            </p>
          </div>
          <div className="pb-12 flex justify-center">
            <Link
              href={'/login'}
              className="text-4xl font-body px-12 hover:bg-gray-300"
            >
              ログインする
            </Link>
            <Link
              href={'/sign-in'}
              className="text-4xl font-body px-12 hover:bg-gray-300"
            >
              登録する
            </Link>
          </div>
          <div className="text-center pb-20">
            <Link
              href={'/home'}
              className="text-2xl font-body text-gray-500 px-12 hover:bg-gray-300"
            >
              ゲストログインする
            </Link>
          </div>
        </div>
      </div>
    </main>
  )
}
