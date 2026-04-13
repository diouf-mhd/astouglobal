import { Link, useNavigate } from 'react-router-dom'
import '../styles/Navigation.css'

function Navigation() {
  const navigate = useNavigate()
  const isLoggedIn = localStorage.getItem('authToken')

  return (
    <nav className="navbar">
      <div className="nav-container">
        <Link to="/" className="nav-logo">AGB Shop</Link>
        <div className="nav-menu">
          <Link to="/" className="nav-link">Accueil</Link>
          <Link to="/vetements" className="nav-link">Vêtements</Link>
          <Link to="/homme" className="nav-link">Homme</Link>
          <Link to="/chaussures" className="nav-link">Chaussures</Link>
          <Link to="/jalabe" className="nav-link">Jalabé</Link>
          <Link to="/parfum" className="nav-link">Parfum</Link>
          {isLoggedIn ? (
            <>
              <Link to="/dashboard" className="nav-link">Dashboard</Link>
              <button className="nav-link" onClick={() => {
                localStorage.removeItem('authToken')
                navigate('/')
              }}>Logout</button>
            </>
          ) : (
            <Link to="/admin" className="nav-link admin-link">Admin</Link>
          )}
        </div>
      </div>
    </nav>
  )
}

export default Navigation
