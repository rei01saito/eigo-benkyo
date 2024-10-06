'use client'

import { Button, Card, Input } from '@nextui-org/react'

const Login = () => {
  return (
    <div className="mx-auto">
      <div className="w-[480px] mx-auto my-8">
        <Card className="text-center py-6">
          <h2 className="text-center pb-8">Login</h2>
          <div className="flex"></div>
          <form action="">
            <Input label="email" className="w-[240px] mx-auto my-4" />
            <Input label="password" className="w-[240px] mx-auto my-4" />
            <div className="flex items-center justify-center pt-6">
              <Button size="md" type="submit">
                ログイン
              </Button>
            </div>
          </form>
        </Card>
      </div>
    </div>
  )
}

export default Login
