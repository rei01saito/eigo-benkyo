import Footer from '@/components/layouts/Footer'
import { Header } from '@/components/layouts/Header'
import type { Metadata } from 'next'
import { Inter } from 'next/font/google'
import './globals.css'

const inter = Inter({ subsets: ['latin'] })

export const metadata: Metadata = {
  title: 'Katask',
  description: 'タスク管理アプリKatask',
}

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode
}>) {
  return (
    <html lang="ja">
      <head>
        <meta charSet="utf-8"></meta>
        <meta
          name="viewport"
          content="width=device-width, initial-scale=1"
        ></meta>
        <link
          rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"
        ></link>
      </head>
      <body className="font-sans text-gray-900 antialiased">
        <Header></Header>

        {children}

        <Footer></Footer>
      </body>
    </html>
  )
}
