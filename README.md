# Laravel Project

This is a Laravel project. Follow the steps below to set it up locally.

---

## Prerequisites

- PHP >= 8.1
- Composer
- Node.js & npm (for frontend assets)
- MySQL or another supported database

---

## Installation

1. **Clone the repository**

```bash
git clone https://github.com/SEVerhaak/CAIT-Website CAIT-Website
cd CAIT-Website
```
2. **Install PHP dependencies**
```bash
composer install
```
3. **Copy environment file**
```bash
cp .env.example .env
```
4. **Generate application key**
```bash
php artisan key:generate
```
5. **Run migrations and seeders**
```bash
php artisan migrate
```
7. **Install Node dependencies and compile assets**
```bash
npm install
```
8. **Run the local development server**
```bash
composer run dev
```
