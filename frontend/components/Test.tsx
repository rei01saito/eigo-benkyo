'use client'

import { useState } from 'react'

export const Test = () => {
  const [value, setValue] = useState<string>()

  return (
    <>
      <h1>This is test.</h1>
    </>
  )
}
