import Task from '@/app/task/page'
import { useRequest } from '@/hooks/useRequest'

export const fetchTasks = () => {
  const data = useRequest<Task[]>('/api/tasks')
  return data ?? []
}
