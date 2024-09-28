import { NextResponse } from 'next/server'
import jsonData from '../../../test.json'

export const GET = () => {
  // const res = await fetch('/test.json')
  // const data = res.json()
  return NextResponse.json(jsonData.tasks)
}
