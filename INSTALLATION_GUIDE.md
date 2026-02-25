# EduCore – Coaching Management SaaS Installation Guide

Welcome to the EduCore SaaS Application. This project is built dynamically on Laravel 10+ and MySQL, emphasizing a single-database multi-tenant structure using an `institute_id` global scope.

## 1. Prerequisites
- PHP 8.1+
- Composer
- MySQL 8.0+
- Node.js & NPM

## 2. Setting Up the Project
Since this repository structure has been scaffolded for you with the core architecture files, follow these steps to turn it into a fully functional application:

### Step 1: Initialize Laravel
Execute this command in `c:\laragon\www`:
```bash
composer create-project laravel/laravel edu
```
*Note: If you already placed the scaffolded files in `c:\laragon\www\edu`, ensure you don't override them, or move them into the newly generated Laravel directory.*

### Step 2: Install Authentication Stubs
```bash
cd edu
composer require laravel/breeze --dev
php artisan breeze:install
```

### Step 3: Install Required Packages
For Razorpay integration:
```bash
composer require razorpay/razorpay
```

### Step 4: Configure the Environment
Copy `.env.example` to `.env` and set up your database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=educore_db
DB_USERNAME=root
DB_PASSWORD=

RAZORPAY_KEY=your_razorpay_key
RAZORPAY_SECRET=your_razorpay_secret
```

### Step 5: Run Migrations
Our custom migrations dictate the multi-tenant architecture. Ensure they are executed:
```bash
php artisan migrate
```

### Step 6: Build the Frontend
Since we provided a Sample Bootstrap 5 layout inside `resources/views/layouts/admin.blade.php`, you can compile assets if needed or just use the CDN provided. For Breeze standard views:
```bash
npm install
npm run build
```

### Step 7: Apply Middlewares in Kernel
Register the Middleware provided in `app/Http/Kernel.php` (for Laravel 10) or `bootstrap/app.php` (for Laravel 11):
```php
protected $routeMiddleware = [
    // ...
    'role' => \App\Http\Middleware\CheckRole::class,
    'tenant' => \App\Http\Middleware\IdentifyTenant::class,
    'subscription' => \App\Http\Middleware\CheckSubscription::class,
];
```

## 3. Usage & Testing Architecture
### Multi-Tenancy (TenantScope)
The multi-tenancy is handled via the `App\Models\Scopes\TenantScope`.
When a user logs in, the `IdentifyTenant` middleware assigns `session(['institute_id' => $user->institute_id])`.
Any model using the `BelongsToInstitute` trait (like Student, Payment, etc.) will automatically append `WHERE institute_id = ?` to all SELECT queries, and automatically inject `institute_id` on INSERTs.

### Razorpay Subscriptions
See `App\Services\SubscriptionService` for how new subscriptions are handled and attached to the Institute.

## 4. Run the local server
```bash
php artisan serve
```
Visit `http://localhost:8000` to start using your SaaS!
