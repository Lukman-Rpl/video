import { Link } from "react-router-dom";
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import { useState } from 'react'
import './App.css'
import Kontak from './pages/Kontak'
import Nav from './pages/Nav'
import Sejarah from './pages/Sejarah'
import Tentang from './pages/Tentang'
import Home from './pages/Home'
import Siswa from './pages/Siswa'
import Menu from './pages/Menu'
import { BrowserRouter, Route, Routes,  } from "react-router-dom";

function App() {
  const [count, setCount] = useState(0)

  return (
    <BrowserRouter>
      <div className="App">
        <Nav />
        <Routes>
        <Route path='/' element={<Home />} />
        <Route path='/kontak' element={<Kontak />} />
        <Route path='/tentang' element={<Tentang />} />
        <Route path='/sejarah' element={<Sejarah />} />
        <Route path='/siswa' element={<Siswa />} />
        <Route path='/menu' element={<Menu />} />
        </Routes>
      </div>
      </BrowserRouter>
  )
}

export default App
