import apiClient from './api'

export const productService = {
  getByCategory: (category) => 
    apiClient.get(`/products?category=${category}`),
  
  getAll: () => 
    apiClient.get('/products'),
  
  getById: (id) => 
    apiClient.get(`/products/${id}`),
  
  addProduct: (productData) => 
    apiClient.post('/admin/products', productData),
  
  deleteProduct: (categoryId, productId) => 
    apiClient.delete(`/admin/products/${categoryId}/${productId}`),
}

export const authService = {
  login: (credentials) => 
    apiClient.post('/admin/login', credentials),
  
  logout: () => 
    apiClient.post('/admin/logout'),
  
  getCurrentUser: () => 
    apiClient.get('/admin/me'),
}
