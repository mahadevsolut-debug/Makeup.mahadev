# Makeup.mahadev - Luxury Makeup Artist & Studio SaaS System

`Makeup.mahadev` is a production-ready, scalable, admin-controlled website template built with PHP 8+ MVC architecture, MySQL PDO, Tailwind CSS, Alpine.js, and PHPMailer. Designed specifically for makeup artists, bridal makeover studios, and high-fashion stylists, it allows complete management of services, dynamic packages, add-on pricing, portfolio lookbooks, client requests, and website content without touching code.

---

## 🌟 Core Features

- **Dynamic Tiered Pricing Engine**: Supports simple fixed service pricing as well as multi-tier packages (Basic, Silver, Gold, Premium) with customizable add-ons (Hair styling, Saree draping, Travel fee, Extra guest makeup).
- **Interactive Service Request & Booking System**: Instant real-time price calculation powered by Alpine.js and automatic dual SMTP email alerts (Admin alert + Customer confirmation).
- **Full Role-Based Admin CMS Panel**: Complete control over services, package tiers, add-ons, booking statuses, lookbook media uploads, testimonials, team profiles, and website branding settings.
- **Modern Responsive Aesthetics**: Dark glassmorphic design system tailored with HSL colors, micro-animations, lightbox galleries, before/after transformation previews, sticky booking triggers, and a floating WhatsApp widget.
- **SaaS-Ready Architecture**: Clean modular codebase using native PHP 8+ MVC pattern, prepared PDO statements for security against SQL injection, CSRF protection, and MIME-verified media uploading.

---

## 📁 Project Folder Structure

```
Makeup.mahadev/
├── app/
│   ├── Controllers/       # HTTP Controllers (Public & Admin)
│   ├── Core/              # System Engine (Router, Database, Session, CSRF, Uploader, Mailer)
│   ├── Models/            # Database Models & Business Logic
│   └── Views/             # UI Templates (Frontend & Admin Layouts)
├── config/
│   └── config.php         # Application & Environment Settings
├── database/
│   ├── schema.sql         # 16 Relational MySQL Database Tables
│   └── seeds.sql          # Pre-populated Default Services, Packages & Admin User
├── public/
│   ├── .htaccess          # Apache Rewrite Rules
│   ├── index.php          # Front Controller Entry Point
│   ├── uploads/           # Uploaded Portfolio & Service Images
│   └── assets/            # CSS & JavaScript Static Assets
├── .htaccess              # Root Apache Directory Redirection
├── composer.json          # Dependency Manager Configuration
└── README.md              # Setup Documentation
```

---

## 🛠️ Installation & Setup Instructions

### 1. Database Setup
1. Open your MySQL management tool (e.g., phpMyAdmin, TablePlus, or MySQL CLI).
2. Create a new database named `makeup_mahadev`.
3. Import `database/schema.sql` into `makeup_mahadev`.
4. Import `database/seeds.sql` into `makeup_mahadev`.

### 2. Environment & Configuration
1. Open `config/config.php`.
2. Verify database connection credentials:
   ```php
   define('DB_HOST', '127.0.0.1');
   define('DB_NAME', 'makeup_mahadev');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ```

### 3. Running Locally
- Point your Apache / Nginx virtual host or local PHP dev server to the `public/` directory or root directory of `Makeup.mahadev`.
- Using PHP built-in server from root directory:
  ```bash
  php -S localhost:8000 -t public
  ```

---

## 🔐 Admin Access Credentials

- **Admin Login URL**: `http://localhost/admin/login` (or `http://localhost:8000/admin/login`)
- **Email**: `admin@makeupmahadev.com`
- **Default Password**: `admin123`

*(Note: Change your password and update shop email addresses under the **Website Settings** tab after initial login).*

---

## 📄 License

This SaaS template is built for modular deployment across multiple client installations.
