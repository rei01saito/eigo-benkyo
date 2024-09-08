import { Meta, StoryObj } from '@storybook/react'
import { Test } from '../components/Test'

const meta = {
  component: Test,
} satisfies Meta<typeof Test>
export default meta
type Story = StoryObj<typeof meta>

export const Sample: Story = {}
