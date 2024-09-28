import { Task } from '@/features/task/types'
import { useRequest } from '@/hooks/useRequest'

export const useTasks = () => {
  const { data } = useRequest<Task[]>('/api/task')
  return data ?? []
}
