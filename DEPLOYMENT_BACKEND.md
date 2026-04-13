# AGB Shop Backend Deployment Guide

## CodeIgniter 4 Backend Deployment

### Prerequisites
- PHP 8.2 or higher
- MySQL/MariaDB
- Composer
- SSH/FTP access to hosting

### Recommended Hosting Providers

1. **Railway.app** (Easy, Node.js-like experience)
   - Supports PHP with Procfile
   - Free tier available
   - Good for small projects

2. **Render.com**
   - PHP support
   - Free SSL
   - Good performance

3. **Traditional PHP Hosting**
   - Bluehost
   - SiteGround
   - Hostinger
   - Namecheap

4. **AWS/DigitalOcean**
   - Full control
   - Scale as needed
   - Higher cost

### Deployment Steps

#### 1. Prepare Your CodeIgniter App

```bash
# Install dependencies
composer install --no-dev --optimize-autoloader

# Generate app key (if needed)
php spark env set encryption.key "$(php -r 'echo bin2hex(random_bytes(16));')"

# Run migrations
php spark migrate
```

#### 2. Environment Configuration

Create `.env` file:
```bash
CI_ENVIRONMENT = production

app.baseURL = 'https://your-domain.com/'
app.forceGlobalSecureRequests = true
app.CSPEnabled = true

database.default.hostname = your_db_host
database.default.database = your_db_name
database.default.username = your_db_user
database.default.password = your_db_password
database.default.port = 3306

# Security
encryption.key = your_encryption_key
```

#### 3. Update CORS Configuration

Update `app/Config/Cors.php`:
```php
'allowedOrigins' => [
    'https://your-frontend-domain.com',
    'https://your-app.vercel.app',
],

'allowedOriginsPatterns' => [
    'https://.*\.vercel\.app',
],
```

#### 4. For Railway.app Deployment

Create `Procfile`:
```
web: vendor/bin/heroku-php-apache2 public/
```

Create `railway.json`:
```json
{
  "builder": "nixpacks",
  "buildCommand": "composer install",
  "startCommand": "php spark serve --host=0.0.0.0 --port=$PORT"
}
```

#### 5. For Traditional Hosting

Upload files via FTP/SFTP:
- Upload all files except `.env.example`, `writable/.gitignore`
- Rename `.env.example` to `.env` and update values
- Set `writable/` folder permissions to 755
- Set database credentials in `.env`
- Run migrations via CLI: `php spark migrate`

#### 6. Database Setup

```bash
# Create database
CREATE DATABASE agb_shop;

# Import existing database
mysql -u username -p agb_shop < bd/agb_shop.sql
```

#### 7. File Uploads Configuration

Ensure `public/uploads/` directory exists and is writable:
```bash
mkdir -p public/uploads/products/{vetements,homme,chaussures,jalabe,parfum}
chmod -R 755 public/uploads/
```

#### 8. HTTPS/SSL Certificate

- Railway.app: Automatic SSL
- Render.com: Automatic SSL
- Traditional hosting: Use Let's Encrypt (free)

### Security Considerations

1. **Never commit `.env` file** to Git
2. Use strong database passwords
3. Enable HTTPS only
4. Set `app.forceGlobalSecureRequests = true`
5. Keep CodeIgniter and dependencies updated

### Environment Variables

| Variable | Example |
|----------|---------|
| `CI_ENVIRONMENT` | `production` |
| `app.baseURL` | `https://backend.example.com/` |
| `database.default.hostname` | `db.example.com` |
| `database.default.database` | `agb_shop` |
| `database.default.username` | `db_user` |
| `database.default.password` | `secure_password` |
| `encryption.key` | `your_encryption_key` |

### API Endpoints Available

```
GET    /api/products
GET    /api/products/category/:category
GET    /api/products/:id
POST   /api/admin/login
POST   /api/admin/logout
POST   /api/admin/products
DELETE /api/admin/products/:categoryId/:productId
```

### Troubleshooting

1. **500 Error on Deployment**
   - Check error logs in `writable/logs/`
   - Verify all dependencies installed with Composer
   - Check database connection

2. **Database Connection Failed**
   - Verify credentials in `.env`
   - Check database server accessibility
   - Ensure database user has proper permissions

3. **File Upload Issues**
   - Check `public/uploads/` permissions
   - Ensure directory is writable
   - Check file size limits

4. **CORS Errors**
   - Update `app/Config/Cors.php` with frontend URL
   - Ensure PHP CORS filter is enabled in routes

### Backup & Recovery

Regular backups:
```bash
# Backup database
mysqldump -u user -p agb_shop > backup_$(date +%Y%m%d).sql

# Backup uploads
tar -czf uploads_backup_$(date +%Y%m%d).tar.gz public/uploads/
```

### Monitoring

Monitor logs in `writable/logs/`:
```bash
tail -f writable/logs/log-*.log
```

## CI/CD with GitHub Actions

Create `.github/workflows/deploy.yml` for automatic deployment on push.
