'use client'

import { Card } from '@nextui-org/react'

const EmailConfirmation = () => {
  return (
    <div className="mx-auto">
      <div className="w-[480px] mx-auto my-8">
        <Card className="text-center py-6">
          <p>認証メールを送信しました。ご確認ください。</p>
        </Card>
      </div>
    </div>
  )
}

export default EmailConfirmation
