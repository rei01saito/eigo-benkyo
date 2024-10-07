import { Button, Card, Input } from '@nextui-org/react'

const PasswordReset = () => {
  return (
    <div className="mx-auto">
      <div className="w-[480px] mx-auto my-8">
        <Card className="text-center py-6">
          <h2 className="text-center pb-8">Password Reset</h2>
          <p className="text-xs">
            パスワードをリセットします。登録したメールアドレスを入力してください。
          </p>
          <form action="">
            <Input label="email" className="w-[240px] mx-auto my-4" />
            <div className="flex items-center justify-center pt-6">
              <Button size="md" type="submit">
                パスワードをリセットする
              </Button>
            </div>
          </form>
        </Card>
      </div>
    </div>
  )
}

export default PasswordReset
