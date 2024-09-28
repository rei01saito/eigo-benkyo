import { Task } from '@/features/home/types'
import { useRequest } from '@/hooks/useRequest'

export const useTasks = () => useRequest<Task[]>('/api/home')
