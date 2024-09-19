import { NextResponse } from 'next/server'
import json from '../../../test.json'

export const GET = async () => {
  // const res = await fetch('/test.json')
  // const data = res.json()
  const data = json
  return NextResponse.json(data.tasks)
}
