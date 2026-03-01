import { useEffect, useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'

export default function App() {

  // useEffect(() => {
  // const fetchTest = async () => {
  //   try {
  //     const response = await fetch('http://localhost:8000/api/user');

  //     if (!response.ok) {
  //       throw new Error(`HTTP error! status: ${response.status}`);
  //     }

  //     const data = await response.json();
  //     console.log('API data:', data);
  //   } catch (error) {
  //     console.error('Fetch error:', error);
  //   }
  // };

  // fetchTest();
  // }, []);

  return (
    <div className="min-h-screen flex items-center justify-center bg-slate-900 text-white">
      <h1 className="text-4xl font-bold">Tailwind + React works ✅</h1>

      <button className='bg-pink-500 p-2 rounded-md hover:bg-red-200' >Click</button>
    </div>
  )
}
