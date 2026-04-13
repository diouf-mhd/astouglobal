import { useState, useEffect } from 'react'
import { productService } from '../services/productService'
import '../styles/ProductCategory.css'

function ProductCategory({ category }) {
  const [products, setProducts] = useState([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState(null)

  useEffect(() => {
    const fetchProducts = async () => {
      try {
        setLoading(true)
        const response = await productService.getByCategory(category)
        setProducts(response.data.products || [])
      } catch (err) {
        setError(err.message)
      } finally {
        setLoading(false)
      }
    }

    fetchProducts()
  }, [category])

  if (loading) return <div className="container"><p>Chargement...</p></div>
  if (error) return <div className="container"><p>Erreur: {error}</p></div>

  return (
    <div className="container">
      <h1>{category.charAt(0).toUpperCase() + category.slice(1)}</h1>
      <div className="products-grid">
        {products.map((product) => (
          <div key={product.id} className="product-card">
            {product.image && <img src={product.image} alt={product.name} />}
            <h3>{product.name}</h3>
            <p>{product.description}</p>
            <p className="price">${product.price}</p>
          </div>
        ))}
      </div>
    </div>
  )
}

export default ProductCategory
