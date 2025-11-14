# 🚀 RK Trading Laravel - Railway Deployment Guide

## Prerequisites
- GitHub account
- Railway.app account (free tier available)
- Your Laravel project with the BadMethodCallException fix

## Step 1: Prepare Your Code for Deployment

### ✅ Already Done:
- [x] Added `scopeActive` method to Product model
- [x] Created `railway.json` for Railway configuration
- [x] Created `nixpacks.toml` for build configuration
- [x] Updated `.gitignore` for production
- [x] Created `.env.production` template

### 📝 Additional Setup Needed:

1. **Create .env file locally** (if not exists):
```bash
cp .env.example .env
php artisan key:generate
```

2. **Configure database in .env**:
```env
DB_CONNECTION=sqlite
DB_DATABASE=/app/database/database.sqlite
```

## Step 2: Upload to GitHub

1. **Create a new repository on GitHub**:
   - Go to https://github.com/new
   - Repository name: `rk-trading-laravel`
   - Make it public or private
   - Don't initialize with README

2. **Initialize Git and push**:
```bash
cd rk-trading-laravel
git init
git add .
git commit -m "Initial commit: RK Trading Laravel with Product::active() fix"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/rk-trading-laravel.git
git push -u origin main
```

## Step 3: Deploy to Railway

1. **Connect to Railway**:
   - Go to https://railway.app
   - Sign in with your account
   - Click "New Project"
   - Choose "Deploy from GitHub repo"

2. **Select your repository**:
   - Search for `rk-trading-laravel`
   - Click "Deploy"

3. **Railway will auto-detect Laravel** and start building

## Step 4: Database Setup

1. **Add MySQL Database**:
   - In Railway dashboard, click "Add" → "Database" → "MySQL"
   - This creates a MySQL database for your app

2. **Connect Database to App**:
   - Go to your app service
   - Click "Variables" tab
   - Add these environment variables:
   ```
   DB_CONNECTION=mysql
   DB_HOST=${{MYSQLHOST}}
   DB_PORT=${{MYSQLPORT}}
   DB_DATABASE=${{MYSQLDATABASE}}
   DB_USERNAME=${{MYSQLUSER}}
   DB_PASSWORD=${{MYSQLPASSWORD}}
   ```

## Step 5: Environment Configuration

1. **Set Required Variables**:
   - In Railway app variables, add:
   ```
   APP_NAME="RK Trading"
   APP_ENV=production
   APP_KEY=base64:YOUR_APP_KEY_HERE
   APP_DEBUG=false
   APP_URL=https://your-app-name.railway.app
   ```

2. **Generate App Key**:
   - Run locally: `php artisan key:generate --show`
   - Copy the generated key to Railway variables

## Step 6: Run Migrations

1. **Open Railway Terminal**:
   - Go to your app service
   - Click "Terminal" tab

2. **Run Commands**:
```bash
php artisan migrate
php artisan db:seed  # If you have seeders
```

## Step 7: Test Your Deployed App

1. **Get your Railway URL**:
   - In Railway dashboard, your app will have a URL like: `https://rk-trading-laravel-production.up.railway.app`

2. **Test the fix**:
   - Visit: `https://your-app-url.railway.app/test-products`
   - Should return JSON confirming Product::active() works

3. **Test main functionality**:
   - Home page: `https://your-app-url.railway.app/`
   - Login: `https://your-app-url.railway.app/login`
   - Register: `https://your-app-url.railway.app/register`

## Troubleshooting

### Build Issues:
- Check Railway build logs for errors
- Ensure `composer.json` and `package.json` are valid

### Runtime Issues:
- Check Railway deploy logs
- Verify environment variables are set correctly
- Test database connection: `php artisan tinker` then `DB::connection()->getPdo()`

### Migration Issues:
- Ensure database is connected
- Check migration files exist
- Run `php artisan migrate:status` to see status

## Cost Information
- Railway free tier: 512MB RAM, 1GB disk
- MySQL database: $5/month (first database free for 1 month)
- Should be sufficient for testing your RK Trading app

## Success Checklist
- [ ] Code uploaded to GitHub
- [ ] Railway deployment successful
- [ ] Database connected
- [ ] Migrations run
- [ ] App accessible online
- [ ] `/test-products` endpoint returns success
- [ ] Home page loads without BadMethodCallException
