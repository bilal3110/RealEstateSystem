# ZameenDesk - Real Estate Management System

ZameenDesk is a comprehensive Real Estate Management System built with Laravel, designed to streamline the operations of real estate agencies. It provides a centralized platform to manage property listings, track sales and rental processes, monitor investments, and manage leads (seekers).

## 🚀 Key Features

- **Property Management**: 
    - Full CRUD (Create, Read, Update, Delete) for properties available for **Sale** and **Rent**.
    - Multi-image upload for property listings.
- **Transaction Tracking**:
    - **Sold-out Properties**: Detailed tracking of property sales including buyer/seller info, advance payments, and commissions.
    - **Rented-out Properties**: Management of rental agreements, tenant details, and security deposits.
- **Investment Management**: 
    - Track property investments and their subsequent disposal/sale.
- **Seeker Management**: 
    - Lead management system to store and track potential buyers/tenants (seekers).
- **Financial Dashboard**: 
    - Track office **Spendings** and calculate monthly **Profits** (Net Income, Rent Income, Sale Income).
- **Business Branding**: 
    - Customizable business details, including name, contact info, and logo.

## 🛠️ Tech Stack

- **Backend**: Laravel 9.x (PHP 8.x)
- **Frontend**: Blade Templates, JavaScript (jQuery), CSS/SASS
- **Database**: MySQL
- **Assets**: Vite / Webpack (Mix)
- **Styling**: Bootstrap / Custom Theme

## 📥 Installation Guide

Follow these steps to set up the project locally:

### 1. Prerequisites
- PHP >= 8.0
- Composer
- MySQL
- Node.js & NPM

### 2. Clone the Repository
```bash
git clone https://github.com/bilal3110/RealEstateSystem.git
cd RealEstateSystem
```

### 3. Install Dependencies
```bash
composer install
npm install
```

### 4. Environment Configuration
Copy the `.env.example` to `.env` and update the database credentials:
```bash
cp .env.example .env
```
Update these lines in `.env`:
```env
DB_DATABASE=realestatesystem
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Run Migrations & Seeders
```bash
php artisan migrate --seed
```

### 7. Run the Application
```bash
# Compile assets
npm run dev

# Start server
php artisan serve
```

## 📸 Image Display Issue Troubleshooting

If images are not appearing:
1. Ensure the `public/storage` symbolic link is correctly created using `php artisan storage:link`.
2. Check that your `APP_URL` in `.env` matches your local development URL (e.g., `http://127.0.0.1:8000`).
3. If using XAMPP directly (without `php artisan serve`), ensure the path in `asset()` helpers aligns with your subfolder structure.

---
Developed by Bilal Dev
