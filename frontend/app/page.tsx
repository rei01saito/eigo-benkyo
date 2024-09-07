'use client';

export default function Home() {
  const handleClick = async () => {
    const data = await fetch('http://localhost:80/api/test')
      .then(data => data.json())
    alert(data)
  }

  return (
    <main>
      <h1 className="text-red-500">Hello world</h1>
      <button onClick={handleClick}>click</button>
    </main>
  );
}
