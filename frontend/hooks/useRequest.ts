import Error from 'next/error'
import useSWR from 'swr'

export const useRequest = <T>(endpointUrl: string): T | undefined => {
  const fetcher = async (url: string) => {
    return await fetch(url).then((res) => res.json())
  }

  const { data, error, isLoading } = useSWR<T, Error>(endpointUrl, fetcher)

  if (error) {
    alert(error)
  }

  return data
}
