'use client'

import useSWR from 'swr'

type Request<T> = {
  data: T | undefined
  isLoading: boolean
}

export const useRequest = <T>(endpointUrl: string): Request<T> => {
  const fetcher = async (url: string) => {
    return await fetch(url).then((res) => res.json())
  }

  const { data, error, isLoading } = useSWR<T, Error>(endpointUrl, fetcher)

  if (error) {
    alert(error)
  }

  return {
    data: data,
    isLoading: isLoading,
  }
}
