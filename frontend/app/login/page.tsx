'use client'

import { Button, Card, Input, Link } from '@nextui-org/react'

const Login = () => {
  return (
    <div className="mx-auto">
      <div className="w-[480px] mx-auto my-8">
        <Card className="text-center py-6">
          <h2 className="text-center pb-8">Login</h2>
          <form action="">
            <Input label="email" className="w-[240px] mx-auto my-4" />
            <Input label="password" className="w-[240px] mx-auto my-4" />
            <div className="flex items-center justify-center pt-6">
              <Button size="md" type="submit">
                ログイン
              </Button>
            </div>
            <Link
              href="password-reset"
              className="text-red-500 hover:opacity-70 text-xs pt-2"
            >
              パスワードを忘れた方
            </Link>
          </form>
        </Card>
      </div>
    </div>
  )
}

export default Login
