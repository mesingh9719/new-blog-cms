<p align="center">
    <a href="#" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg"
             width="320" alt="Laravel Logo">
    </a>
</p>

<h1 align="center">Laravel News & Blog CMS</h1>

<p align="center">
    A clean, modern, Medium-style News & Blog Content Management System built with Laravel 12, FilamentPHP, and TailwindCSS.
</p>

<p align="center">
    <a href="#"><img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square" alt="Laravel Version"></a>
    <a href="#"><img src="https://img.shields.io/badge/Filament-3.x-0EA5E9?style=flat-square" alt="Filament Version"></a>
    <a href="#"><img src="https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=flat-square" alt="Tailwind CSS"></a>
    <a href="#"><img src="https://img.shields.io/badge/License-MIT-green.svg?style=flat-square" alt="License"></a>
</p>

---

## 📌 About the Project

**Laravel News & Blog CMS** is a full-featured Laravel-based content management system with a Medium-style frontend and a clean Filament-powered admin panel.

It supports:

- Modern editorial publishing  
- SEO-ready architecture  
- Responsive TailwindCSS UI  
- Trending logic with view tracking  
- Full RSS + JSON feeds  
- Optimized article structure and clean post pages  

A complete CMS built with production-quality structure and extensibility in mind.

---

## ✨ Features

### 📰 **Content Management**
- Create, edit, publish, and schedule posts  
- Multiple categories & tags per post  
- Rich text editing  
- Auto slugs  
- Custom excerpts  
- SEO meta fields  

### 👤 **User & Author System**
- Multi-author support  
- Author pages  
- Author initials avatar  

### 🔥 **Trending & Analytics**
- View counter  
- Trending posts  
- Recent posts  

### 🎨 **Frontend (Medium Inspired)**
- Clean typography  
- Smooth hover effects  
- Reading progress bar  
- Category, tag, and author pages  
- Dark/Light theme toggle  

### 🛠 **Admin Panel (Filament)**
- Post, Category & Tag CRUD  
- Media uploads  
- Filters, search & sorting  
- Dashboard widgets  

### 📡 **Feeds (RSS + JSON)**
#### RSS:
- `/feed`  
- `/feed/category/{slug}`  
- `/feed/tag/{slug}`  
- `/feed/categories`  
- `/feed/tags`  

#### JSON:
- `/json/feed`  
- `/json/category/{slug}`  
- `/json/tag/{slug}`  

---

## 🧩 Tech Stack

- **Laravel 12.x**
- **FilamentPHP 3.x**
- **TailwindCSS**
- **MySQL / MariaDB**
- **PHP 8.2+**

---

## 🚀 Installation

```bash
git clone https://github.com/mesingh9719/new-blog-cms
cd new-blog-cms
composer install
cp .env.example .env
php artisan key:generate
