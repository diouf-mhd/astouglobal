# AGB Shop Frontend Deployment Guide

## Deployment to Vercel

### Prerequisites
- Node.js 18+ installed
- npm or yarn
- GitHub account (for continuous deployment)
- Vercel account

### Steps

#### 1. Push Frontend to GitHub
```bash
cd frontend
git add .
git commit -m "Add React frontend"
git push origin main
```

#### 2. Connect to Vercel
1. Go to [vercel.com](https://vercel.com)
2. Sign in with GitHub
3. Click "Import Project"
4. Select your repository
5. Select "frontend" as root directory
6. Click "Deploy"

#### 3. Configure Environment Variables in Vercel
1. In Vercel dashboard, go to Project Settings
2. Click "Environment Variables"
3. Add the following:
   - `VITE_API_URL`: Your PHP backend URL (e.g., `https://your-backend.com`)

#### 4. Deploy
Vercel will automatically deploy from your main branch on every push.

### Local Development
```bash
cd frontend
npm install
npm run dev
# Visit http://localhost:5173
```

### Production Build
```bash
npm run build
npm run preview
```

## Environment Configuration

Create `.env.production` file:
```
VITE_API_URL=https://your-php-backend-domain.com
```

For Vercel environment variables, skip the dot prefix:
- Key: `VITE_API_URL`
- Value: `https://your-php-backend-domain.com`

## Vercel Project Setup

In `vercel.json`:
```json
{
  "buildCommand": "npm run build",
  "devCommand": "npm run dev",
  "outputDirectory": "dist",
  "installCommand": "npm install"
}
```

## API Endpoints

The frontend expects the backend to expose these endpoints:

### Products
- `GET /api/products` - Get all products
- `GET /api/products/category/:category` - Get products by category
- `GET /api/products/:id` - Get single product

### Admin
- `POST /api/admin/login` - Admin login
- `POST /api/admin/logout` - Admin logout
- `POST /api/admin/products` - Add product
- `DELETE /api/admin/products/:categoryId/:productId` - Delete product

## CORS Configuration

The backend is configured to allow requests from:
- `http://localhost:3000` (local development)
- `http://localhost:5173` (Vite dev server)
- `https://agb-shop.vercel.app` (your Vercel domain)
- `https://*.vercel.app` (any Vercel deployment)

Update the backend `app/Config/Cors.php` if needed.

## Custom Domain

To use a custom domain:
1. In Vercel dashboard, go to Settings > Domains
2. Add your custom domain
3. Update DNS records as instructed
4. Wait for DNS propagation (usually 24-48 hours)

## Troubleshooting

### CORS Errors
- Check that backend CORS config includes your frontend URL
- Ensure credentials are properly configured

### API Not Reachable
- Verify `VITE_API_URL` environment variable
- Check backend server is running
- Check firewall/security settings

### Build Failures
- Check `npm run build` locally
- Review Vercel build logs
- Ensure all dependencies are installed
