import { TaskList } from '@/features/home/components/TaskIist'
import { Meta, StoryObj } from '@storybook/react'
import jsonData from '../test.json'

const meta = {
  title: 'features/home/TaskList',
  component: TaskList,
  parameters: {
    layout: 'fullscreen',
  },
  tags: ['autodocs'],
} satisfies Meta<typeof TaskList>
export default meta
type Story = StoryObj<typeof meta>

export const Sample: Story = {
  args: {
    tasks: jsonData.tasks.map((task) => {
      return task
    }),
  },
}
