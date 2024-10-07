import { Meta, StoryObj } from '@storybook/react'
import Clock from '../features/home/components/Clock'

const meta = {
  title: 'features/home/Clock',
  component: Clock,
  parameters: {
    layout: 'fullscreen',
  },
  tags: ['autodocs'],
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
