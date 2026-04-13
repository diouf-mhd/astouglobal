# Setup Instructions for AGB Shop

## What's New

Your AGB Shop project has been transformed into a modern **frontend/backend architecture** ready for Vercel deployment:

✅ **React Frontend** - Ready for Vercel deployment  
✅ **REST API Backend** - CodeIgniter updated with API endpoints  
✅ **CORS Configuration** - Enabled for cross-origin requests  
✅ **Deployment Guides** - Complete setup docs for both frontend and backend

## Project Structure

```
agb-shop/
├── frontend/                 # NEW: React app (deploy to Vercel)
│   ├── src/
│   │   ├── App.jsx
│   │   ├── components/
│   │   ├── pages/
│   │   ├── services/
│   │   └── styles/
│   ├── package.json
│   ├── vite.config.js
│   └── vercel.json
├── app/                      # CodeIgniter (keep on PHP hosting)
│   ├── Controllers/
│   │   ├── Home.php         # UPDATED: Added API methods
│   │   └── Admin.php        # UPDATED: Added API methods
│   ├── Traits/
│   │   └── ApiResponse.php  # NEW: For API responses
│   └── Config/
│       └── Cors.php         # UPDATED: Configured for frontend
├── DEPLOYMENT_FRONTEND.md    # NEW: Vercel deployment guide
├── DEPLOYMENT_BACKEND.md     # NEW: PHP hosting guide
└── README_SETUP.md          # NEW: Full project overview
```

## Quick Start

### 1. Frontend Setup

```bash
cd frontend
npm install
npm run dev
# Open http://localhost:5173
```

### 2. Backend Setup

```bash
cd ..
composer install
cp .env.example .env
# Edit .env with your database credentials
php spark migrate
php spark serve
# Runs on http://localhost:8080
```

### 3. Configure Frontend
Update `frontend/.env.development`:
```
VITE_API_URL=http://localhost:8080
```

## Deployment Checklist

### Before Deploying Backend

- [ ] Update `.env` with production database credentials
- [ ] Update `app/Config/Cors.php` with frontend URL
- [ ] Run `composer install --no-dev --optimize-autoloader`
- [ ] Test API endpoints locally
- [ ] Backup database
- [ ] Configure SSL/HTTPS

### Before Deploying Frontend

- [ ] Set `VITE_API_URL` environment variable in Vercel
- [ ] Test production build: `npm run build`
- [ ] Push code to GitHub
- [ ] Connect repository to Vercel

## API Endpoints

All API endpoints are prefixed with `/api`:

### Products
```
GET  /api/products                              # All products
GET  /api/products/category/:category           # Products by category
GET  /api/products/:id                          # Single product
```

### Admin Authentication
```
POST /api/admin/login                           # Admin login
POST /api/admin/logout                          # Admin logout
```

### Product Management (Admin)
```
POST   /api/admin/products                      # Add product
DELETE /api/admin/products/:categoryId/:productId  # Delete product
```

## Environment Variables

### Frontend (Vercel)
```
VITE_API_URL=https://your-backend-domain.com
```

### Backend (.env)
```
CI_ENVIRONMENT=production
app.baseURL=https://your-backend-domain.com/
database.default.hostname=your_db_host
database.default.database=agb_shop
database.default.username=your_db_user
database.default.password=your_db_password
encryption.key=your_encryption_key
```

## Testing API Locally

Using curl:
```bash
# Get all products
curl http://localhost:8080/api/products

# Get products by category
curl http://localhost:8080/api/products/category/vetements

# Admin login
curl -X POST http://localhost:8080/api/admin/login \
  -H "Content-Type: application/json" \
  -d '{"username":"220771234567","password":"password"}'
```

## React Components

The frontend includes the following components:

- **Navigation.jsx** - Top navigation bar
- **Home.jsx** - Home page with category grid
- **ProductCategory.jsx** - Category products display
- **Admin.jsx** - Admin login page
- **Dashboard.jsx** - Admin product management

## File Structure Changes

### Files Added
- `frontend/` - Complete React application
- `app/Traits/ApiResponse.php` - API response helper
- `DEPLOYMENT_FRONTEND.md` - Frontend deployment guide
- `DEPLOYMENT_BACKEND.md` - Backend deployment guide
- `README_SETUP.md` - Full setup guide

### Files Modified
- `app/Controllers/Home.php` - Added API methods
- `app/Controllers/Admin.php` - Added API methods
- `app/Config/Routes.php` - Added API routes
- `app/Config/Cors.php` - Enabled CORS for frontend

## Deployment Options

### Frontend
- **Vercel** (Recommended - automatic from GitHub)
- **Netlify** (Alternative)
- **GitHub Pages** (Static hosting)

### Backend
- **Railway.app** (Easiest - recommended)
- **Render.com** (Good performance)
- **Traditional PHP Hosting** (Bluehost, SiteGround, etc.)
- **AWS/DigitalOcean** (Full control)

## Next Steps

1. **Update Backend Hosting Credentials**
   - Choose a hosting provider (Railway recommended)
   - Update `.env` file with production credentials
   - See `DEPLOYMENT_BACKEND.md` for detailed steps

2. **Deploy Frontend to Vercel**
   - Push code to GitHub
   - Connect repository to Vercel
   - Set environment variables
   - See `DEPLOYMENT_FRONTEND.md` for detailed steps

3. **Configure CORS**
   - Update backend `app/Config/Cors.php` 
   - Replace `agb-shop.vercel.app` with your actual Vercel domain
   - Test API calls from frontend

4. **Test Production API**
   - Verify all endpoints working
   - Check CORS headers
   - Test file uploads
   - Test admin authentication

## Troubleshooting

### CORS Issues
```bash
# Check backend CORS config includes your frontend URL
# Update app/Config/Cors.php with your Vercel domain
```

### API Not Found
```bash
# Verify routes added to app/Config/Routes.php
# Check API routes are in /api group
```

### Frontend Can't Connect
```bash
# Verify VITE_API_URL environment variable is set
# Check backend server is running
# Test API endpoint in browser/curl
```

## Database

Import the SQL file:
```bash
mysql -u username -p agb_shop < bd/agb_shop.sql
```

## Support Resources

- [CodeIgniter 4 Docs](https://codeigniter.com)
- [React Docs](https://react.dev)
- [Vite Docs](https://vitejs.dev)
- [Vercel Docs](https://vercel.com/docs)

---

**Your project is now ready for modern full-stack deployment!** 🚀
