# AGB Shop - Full-Stack E-Commerce Application

A modern e-commerce platform with a React frontend and CodeIgniter 4 backend.

## Project Structure

```
agb-shop/
├── frontend/              # React frontend (Vercel deployment)
│   ├── src/
│   ├── public/
│   ├── package.json
│   └── vercel.json
├── app/                   # CodeIgniter backend
│   ├── Controllers/
│   ├── Models/
│   ├── Config/
│   └── ...
├── public/                # Web root for backend
├── bd/                    # Database SQL files
└── README.md
```

## Architecture

### Frontend (React + Vite)
- Deployed on Vercel
- Communicates with backend via REST API
- Features:
  - Product catalog browsing
  - Admin dashboard
  - Product management
  - Responsive design

### Backend (CodeIgniter 4 + MySQL)
- Deployed on Railway.app / Traditional PHP hosting
- REST API endpoints
- Features:
  - Product management
  - Admin authentication
  - Category-based filtering
  - File uploads
  - CORS support

## Quick Start

### Backend Setup
```bash
cd agb-shop
composer install
cp .env.example .env
# Edit .env with your database credentials
php spark migrate
php spark serve
```

### Frontend Setup
```bash
cd frontend
npm install
npm run dev
# Visit http://localhost:5173
```

## API Endpoints

### Products
- `GET /api/products` - Get all products
- `GET /api/products/category/:category` - Get products by category
- `GET /api/products/:id` - Get single product

### Admin
- `POST /api/admin/login` - Admin login
- `POST /api/admin/logout` - Admin logout  
- `POST /api/admin/products` - Add product
- `DELETE /api/admin/products/:categoryId/:productId` - Delete product

## Deployment

### Frontend Deployment (Vercel)
See [DEPLOYMENT_FRONTEND.md](./DEPLOYMENT_FRONTEND.md)

### Backend Deployment (Railway/Traditional Hosting)
See [DEPLOYMENT_BACKEND.md](./DEPLOYMENT_BACKEND.md)

## Technologies

### Frontend
- React 18
- Vite
- React Router
- Axios
- CSS3

### Backend
- CodeIgniter 4
- PHP 8.2+
- MySQL/MariaDB
- Composer

## Features

### Customer Features
- Browse products by category
- View product details
- Responsive mobile design
- Filter by category
- Order information via WhatsApp

### Admin Features
- Add new products
- Delete products
- Upload product images
- Manage inventory
- Admin authentication

## Environment Variables

### Frontend (.env.production)
```
VITE_API_URL=https://your-backend-domain.com
```

### Backend (.env)
```
CI_ENVIRONMENT=production
app.baseURL=https://your-domain.com/
database.default.hostname=db_host
database.default.database=agb_shop
database.default.username=db_user
database.default.password=db_password
```

## Database

The application uses MySQL with the following tables:
- Users table for admin authentication
- Products catalog stored in JSON file (`writable/product-catalog.json`)

Database schema available in `bd/agb_shop.sql`

## Security

- HTTPS enforced in production
- CORS configured for frontend
- Password hashing for admin authentication
- File upload validation
- SQL injection protection via CodeIgniter ORM
- CSRF protection enabled

## Support

For issues or questions, please refer to:
- [CodeIgniter 4 Documentation](https://codeigniter.com/user_guide/intro/index.html)
- [React Documentation](https://react.dev)
- [Vercel Documentation](https://vercel.com/docs)

## License

See LICENSE file for details.
