# RK Trading Laravel Deployment Guide for Railway

## Overview
This guide will help you deploy your Laravel application to Railway with the BadMethodCallException fix for Product::active() method.

## Prerequisites
- Railway account (https://railway.app)
- GitHub repository pushed with latest changes
- Laravel app with fixed Product::active() method

## Step 1: Connect Repository to Railway
1. Go to [Railway.app](https://railway.app) and log in
2. Click "New Project" → "Deploy from GitHub repo"
3. Select your `Allend2311-rk-trading-laravel` repository
4. Railway will automatically detect Laravel framework

## Step 2: Configure Build Settings
Railway will automatically:
- Detect Laravel framework
- Use Nixpacks for building
- Install PHP 8.3, Composer, Node.js
- Run `composer install --no-dev --optimize-autoloader`
- Run `npm install && npm run build`
- Cache config, routes, and views

## Step 3: Set Up Database
### Add MySQL Database:
1. In Railway dashboard, click "Add" → "Database" → "MySQL"
2. Wait for the database to be ready (usually 2-3 minutes)

### Connect Database to App:
1. Go to your Laravel app service
2. Click "Variables" tab
3. Add these environment variables:

```
DB_CONNECTION=mysql
DB_HOST=${{MYSQLHOST}}
DB_PORT=${{MYSQLPORT}}
DB_DATABASE=${{MYSQLDATABASE}}
DB_USERNAME=${{MYSQLUSER}}
DB_PASSWORD=${{MYSQLPASSWORD}}
```

## Step 4: Configure Environment Variables
Add these required variables in Railway's "Variables" tab:

```
APP_NAME="RK Trading"
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_KEY
APP_DEBUG=false
APP_URL=https://your-app-name.railway.app
```

### Generate APP_KEY:
Run this locally in your project directory:
```bash
php artisan key:generate --show
```
Copy the output (starts with `base64:`) to Railway's APP_KEY variable.

## Step 5: Run Database Migrations
1. Go to your app service → "Terminal" tab in Railway dashboard
2. Run migrations:
```bash
php artisan migrate
```
3. Optional: Run seeders if you have them:
```bash
php artisan db:seed
```

## Step 6: Test Your Deployed App
### Get Your Railway URL:
Your app URL will be shown in the service overview, like:
`https://rk-trading-laravel-production.up.railway.app`

### Test the BadMethodCallException Fix:
Visit: `https://your-app-url.railway.app/test-products`
Should return JSON: `{"status":"success","message":"Product::active() method works!"}`

### Test Main Features:
- Home: `https://your-app-url.railway.app/`
- Login: `https://your-app-url.railway.app/login`
- Register: `https://your-app-url.railway.app/register`
- Admin Dashboard: `https://your-app-url.railway.app/admin/dashboard`
- Customer Dashboard: `https://your-app-url.railway.app/customer/dashboard`

## What Gets Tested
✅ BadMethodCallException Fix: Product::active() method works
✅ Laravel Framework: Proper installation and configuration
✅ Database Connection: MySQL connection and migrations
✅ Routes: All web routes function correctly
✅ Views: Blade templates render properly
✅ Assets: CSS and JS files load correctly

## Cost Breakdown
- Railway App: Free (512MB RAM, 1GB storage)
- MySQL Database: $5/month (1st month free)
- Domain: Free Railway subdomain

## Troubleshooting

### Build Fails:
- Check Railway build logs in the "Logs" tab
- Ensure `composer.json` and `package.json` are valid
- Verify all files are committed to GitHub

### Runtime Errors:
- Check deploy logs in Railway
- Verify all environment variables are set correctly
- Test database connection: `php artisan tinker` → `DB::connection()->getPdo()`

### Migration Issues:
- Ensure database is connected and ready
- Check migration files exist in `database/migrations/`
- Run `php artisan migrate:status` to check migration status

## Success Indicators
Your deployment is successful when:
- [ ] Railway build completes without errors
- [ ] App is accessible at Railway URL
- [ ] `/test-products` returns success JSON
- [ ] Home page loads without BadMethodCallException
- [ ] Database migrations run successfully
- [ ] Login/register functionality works
- [ ] Product listings display correctly
- [ ] Order tracking works for customers

## Additional Notes
- Railway automatically redeploys when you push changes to GitHub
- Monitor your app's performance in the Railway dashboard
- Use Railway's logs for debugging any issues
- Consider upgrading to paid plans for more resources if needed
