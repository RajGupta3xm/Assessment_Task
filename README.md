# 🚀 Multi Authentication System (Laravel)

## 📌 Project Overview
This is a Laravel-based **Multi Authentication System** built with multiple guards.  
The project supports **Admin** and **Customer** roles, secure authentication,  
**large-scale product imports using chunk processing**, and **real-time updates using WebSockets**.

---

## 👥 Roles
- Admin  
- Customer  

---

## ⚙️ Key Features

### 🔐 Authentication & Authorization
- Separate login systems for Admin and Customer  
- Multiple guards configuration  
- Role-based middleware protection  
- Secure session handling  

---

### 📦 Product Management
- Product CRUD system  
- Category management  
- **Bulk product import system**  
- **Chunk-based processing for very large files (5M+ records support)**  
- Memory-efficient imports using background processing  

---

### ⚡ Real-Time System (WebSockets)
- Laravel WebSockets (Reverb + Echo) implementation  
- Real-time customer **online / offline presence**  
- Admin dashboard auto-updates without refresh  
- Live status change on login & logout  
- No AJAX polling, pure WebSocket-based updates  

---

### 🧠 Technical Highlights
- Service-based architecture  
- Event-driven real-time updates  
- Scalable import system using chunks  
- Clean MVC structure  
- Multi-auth guard handling  

---

## 🛠️ Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run dev
php artisan reverb:start
php artisan serve
