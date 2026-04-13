import { Link } from 'react-router-dom'
import '../styles/Home.css'

function Home() {
  const categories = [
    { name: 'Vêtements', path: '/vetements', emoji: '👕' },
    { name: 'Homme', path: '/homme', emoji: '👔' },
    { name: 'Chaussures', path: '/chaussures', emoji: '👞' },
    { name: 'Jalabé', path: '/jalabe', emoji: '👗' },
    { name: 'Parfum', path: '/parfum', emoji: '🧴' },
  ]

  return (
    <div className="container home">
      <section className="hero">
        <h1>Bienvenue chez AGB Shop</h1>
        <p>Découvrez notre collection exclusive</p>
      </section>
      <section className="categories">
        <div className="categories-grid">
          {categories.map((cat) => (
            <Link to={cat.path} key={cat.path} className="category-card">
              <div className="category-icon">{cat.emoji}</div>
              <h3>{cat.name}</h3>
            </Link>
          ))}
        </div>
      </section>
    </div>
  )
}

export default Home
