import { useState } from 'react'
import { useNavigate } from 'react-router-dom'
import { productService } from '../services/productService'
import '../styles/Dashboard.css'

function Dashboard() {
  const [productName, setProductName] = useState('')
  const [productDesc, setProductDesc] = useState('')
  const [productPrice, setProductPrice] = useState('')
  const [productCategory, setProductCategory] = useState('')
  const [productImage, setProductImage] = useState(null)
  const [loading, setLoading] = useState(false)
  const [message, setMessage] = useState(null)
  const navigate = useNavigate()

  // Check if authenticated
  if (!localStorage.getItem('authToken')) {
    navigate('/admin')
    return null
  }

  const handleAddProduct = async (e) => {
    e.preventDefault()
    try {
      setLoading(true)
      const formData = new FormData()
      formData.append('name', productName)
      formData.append('description', productDesc)
      formData.append('price', productPrice)
      formData.append('category', productCategory)
      if (productImage) {
        formData.append('image', productImage)
      }

      await productService.addProduct(formData)
      setMessage('Product added successfully!')
      setProductName('')
      setProductDesc('')
      setProductPrice('')
      setProductCategory('')
      setProductImage(null)
    } catch (err) {
      setMessage('Error adding product: ' + (err.response?.data?.message || err.message))
    } finally {
      setLoading(false)
    }
  }

  return (
    <div className="container dashboard">
      <h1>Admin Dashboard</h1>
      <div className="add-product-form">
        <h2>Add New Product</h2>
        {message && <p className={message.includes('Error') ? 'error' : 'success'}>{message}</p>}
        <form onSubmit={handleAddProduct}>
          <input
            type="text"
            placeholder="Product Name"
            value={productName}
            onChange={(e) => setProductName(e.target.value)}
            required
          />
          <textarea
            placeholder="Product Description"
            value={productDesc}
            onChange={(e) => setProductDesc(e.target.value)}
            required
          />
          <input
            type="number"
            placeholder="Price"
            value={productPrice}
            onChange={(e) => setProductPrice(e.target.value)}
            step="0.01"
            required
          />
          <select value={productCategory} onChange={(e) => setProductCategory(e.target.value)} required>
            <option value="">Select Category</option>
            <option value="vetements">Vêtements</option>
            <option value="homme">Homme</option>
            <option value="chaussures">Chaussures</option>
            <option value="jalabe">Jalabé</option>
            <option value="parfum">Parfum</option>
          </select>
          <input
            type="file"
            accept="image/*"
            onChange={(e) => setProductImage(e.target.files[0])}
          />
          <button type="submit" disabled={loading}>
            {loading ? 'Adding...' : 'Add Product'}
          </button>
        </form>
      </div>
    </div>
  )
}

export default Dashboard
