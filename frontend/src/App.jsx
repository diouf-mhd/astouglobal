import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'
import Home from './pages/Home'
import ProductCategory from './pages/ProductCategory'
import Admin from './pages/Admin'
import Dashboard from './pages/Dashboard'
import Navigation from './components/Navigation'
import './App.css'

function App() {
  return (
    <Router>
      <Navigation />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/vetements" element={<ProductCategory category="vetements" />} />
        <Route path="/homme" element={<ProductCategory category="homme" />} />
        <Route path="/chaussures" element={<ProductCategory category="chaussures" />} />
        <Route path="/jalabe" element={<ProductCategory category="jalabe" />} />
        <Route path="/parfum" element={<ProductCategory category="parfum" />} />
        <Route path="/admin" element={<Admin />} />
        <Route path="/dashboard" element={<Dashboard />} />
      </Routes>
    </Router>
  )
}

export default App
