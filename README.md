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
1. Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```
2. Populate the `.env` file with your local database credentials:
   ```env
   APP_ENV=development
   APP_DEBUG=true
   DB_HOST=127.0.0.1
   DB_NAME=makeup_mahadev
   DB_USER=root
   DB_PASS=
   ```

### 3. Running Locally
- Point your Apache / Nginx virtual host or local PHP dev server to the `public/` directory or root directory of `Makeup.mahadev`.
- Using PHP built-in server from root directory:
  ```bash
  php -S localhost:8000 -t public
  ```

---

## 🚀 Hostinger & GitHub Deployment Guide

This repository includes a configured GitHub Actions workflow (`.github/workflows/deploy.yml`) for automated SFTP deployment to Hostinger.

### Step 1: Prepare Database on Hostinger
1. Log in to your Hostinger hPanel and create a new **MySQL Database & User**.
2. Note the database hostname (usually `localhost`), database name, user, and password.
3. Import the `database/schema.sql` and `database/seeds.sql` files via phpMyAdmin.

### Step 2: Configure Environment Variables
1. Using Hostinger hPanel File Manager, create a `.env` file at the root of your `public_html/` folder.
2. Populate it with Hostinger specific database credentials:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   DB_HOST=localhost
   DB_NAME=u123456789_mahadev
   DB_USER=u123456789_admin
   DB_PASS=YourSecurePassword Here
   ```

### Step 3: Add Repository Secrets on GitHub
To authorize automatic deployments, configure these secrets in your GitHub repository (**Settings > Secrets and variables > Actions**):
* `HOSTINGER_FTP_SERVER` - Your Hostinger FTP Host (e.g., `ftp.yourdomain.com` or server IP).
* `HOSTINGER_FTP_USERNAME` - Your Hostinger FTP Username.
* `HOSTINGER_FTP_PASSWORD` - Your Hostinger FTP Password.

On every push to `main`, GitHub will compile and transfer the new updates directly to your site directory.

---

## 🔐 Admin Access Credentials

- **Admin Login URL**: `https://yourdomain.com/admin/login`
- **Email**: `admin@makeupmahadev.com`
- **Default Password**: `admin123`

*(Note: Change your password and update shop email addresses under the **Website Settings** tab after initial login).*

---

## 📄 License

This SaaS template is built for modular deployment across multiple client installations.
