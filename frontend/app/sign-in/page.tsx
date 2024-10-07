'use client'

import { Button, Card, Input } from '@nextui-org/react'

const SignIn = () => {
  return (
    <div className="mx-auto">
      <div className="w-[480px] mx-auto my-8">
        <Card className="text-center py-6">
          <h2 className="text-center pb-8">Sign in</h2>
          <form action="/email-verification">
            <Input label="email" className="w-[240px] mx-auto my-4" />
            <Input label="password" className="w-[240px] mx-auto my-4" />
            <div className="flex items-center justify-center pt-6">
              <Button size="md" type="submit">
                登録する
              </Button>
            </div>
          </form>
        </Card>
      </div>
    </div>
  )
}

export default SignIn
