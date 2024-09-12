import { Meta, StoryObj } from '@storybook/react'
import Clock from '../features/home/Clock'

const meta = {
  title: 'features/Clock',
  component: Clock,
} satisfies Meta<typeof Clock>
export default meta
type Story = StoryObj<typeof meta>

export const Sample: Story = {
  args: {
    tasks: [
      {
        id: 1,
        title: 'Toeicの勉強',
        minutes: 1,
        contents: 'Listening',
      },
    ],
  },
}
