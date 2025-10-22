# LLCF Laravel Project

Welcome to the LLCF Laravel-based project. This guide will walk you through the steps required to set up and run the application locally.

---

## 📦 Requirements

Ensure the following software is installed on your system:

- PHP >= 8.x
- Composer
- MySQL or another compatible database
- Laravel CLI (`composer global require laravel/installer`)
- Node.js and npm (optional, for frontend assets)

---

## 🚀 Getting Started

### 1. Clone the Repository

```bash
git clone https://your-repo-url.git
cd llcf
```

### 2. Install Backend Dependencies
```bash
composer install
```

### 3. (Optional) Install Frontend Dependencies
```bash
npm install
npm run dev
```

## ⚙️ Environment Setup

### 1. Copy Environment File
```bash
cp .env.example .env
```

### 2. Generate Application Key
```bash
php artisan key:generate
```

### 3. Configure Environment
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

## 🧱 Database Setup

### 1. Run Migrations
```bash
php artisan migrate
```

### 2. Seed Initial Data
```bash
php artisan db:seed
```

## 🖥️ Run the Development Server
```bash
php artisan serve
```