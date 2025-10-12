# 🚨 Incident Report Management System

[![Laravel](https://img.shields.io/badge/Laravel-12.0-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.1.0-38B2AC.svg)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

> **Professional Incident Report Management System** dengan Role-Based Access Control, Excel Export, dan Modern UI Design.

## 📋 **Table of Contents**

-   [🎯 Overview](#-overview)
-   [🛠️ Tech Stack](#️-tech-stack)
-   [✨ Features](#-features)
-   [🚀 Installation](#-installation)
-   [📊 Database Setup](#-database-setup)
-   [👥 User Accounts](#-user-accounts)
-   [🎨 UI/UX Design](#-uiux-design)
-   [📁 Project Structure](#-project-structure)
-   [🔧 Configuration](#-configuration)
-   [🧪 Testing](#-testing)
-   [📦 Deployment](#-deployment)
-   [🤝 Contributing](#-contributing)
-   [📄 License](#-license)

## 🎯 **Overview**

**Incident Report Management System** adalah aplikasi web profesional untuk mengelola laporan kejadian tidak terduga dalam organisasi. Sistem ini dirancang dengan **Clean Architecture**, **Role-Based Access Control**, dan **Modern UI Design** untuk memberikan pengalaman pengguna yang optimal.

### **🎯 Key Benefits:**

-   ✅ **Professional UI/UX**: Monochrome minimalist design
-   ✅ **Role-Based Security**: Admin dan User dengan akses berbeda
-   ✅ **Excel Export**: Export data dengan format yang proper
-   ✅ **File Upload**: Support foto pendukung
-   ✅ **Responsive Design**: Mobile-friendly interface
-   ✅ **Clean Code**: Mengikuti best practices Laravel

## 🛠️ **Tech Stack**

### **Backend Framework**

-   **Laravel 12.0** - Modern PHP Framework
-   **PHP 8.2+** - Latest PHP version
-   **MySQL** - Database management
-   **Laravel Breeze** - Authentication scaffolding

### **Frontend Technologies**

-   **TailwindCSS 3.1.0** - Utility-first CSS framework
-   **AlpineJS 3.4.2** - Lightweight JavaScript framework
-   **Vite 7.0.7** - Modern build tool
-   **PostCSS** - CSS processing

### **Additional Packages**

-   **Maatwebsite Excel 3.1** - Excel export functionality
-   **Laravel Pail** - Log viewer
-   **Laravel Pint** - Code style fixer
-   **PHPUnit** - Testing framework

### **Development Tools**

-   **Laravel Sail** - Docker development environment
-   **Laravel Tinker** - REPL for Laravel
-   **Concurrently** - Run multiple commands

## ✨ **Features**

### **🔐 Authentication & Authorization**

-   **User Registration/Login** dengan Laravel Breeze
-   **Role-Based Access Control** (Admin/User)
-   **Profile Management** dengan foto profil
-   **Secure Password Reset** functionality

### **📊 Admin Dashboard**

-   **Statistics Cards** - Total, Baru, Proses, Selesai
-   **Reports Management** - View, update status
-   **Excel Export** - Export data dengan format proper
-   **Real-time Updates** - Status perubahan real-time

### **📝 Report Management**

-   **Create Reports** - Form pelaporan lengkap
-   **File Upload** - Foto pendukung (JPG, PNG, GIF)
-   **Status Tracking** - Baru → Proses → Selesai
-   **Data Validation** - Input validation yang ketat

### **📈 Excel Export**

-   **Professional Formatting** - Styling dan column widths
-   **Data Integrity** - NIK format tanpa scientific notation
-   **Timestamp Filename** - `reports_YYYY-MM-DD_HH-mm-ss.xlsx`
-   **Complete Data** - Semua field reports

### **🎨 UI/UX Features**

-   **Monochrome Design** - Professional gray theme
-   **Responsive Layout** - Mobile-first approach
-   **Clean Typography** - Readable fonts
-   **Intuitive Navigation** - User-friendly interface
-   **Loading States** - Smooth user experience

## 🚀 **Installation**

### **📋 Prerequisites**

Pastikan sistem Anda memiliki:

-   **PHP 8.2+** dengan extensions: BCMath, Ctype, cURL, DOM, Fileinfo, JSON, Mbstring, OpenSSL, PCRE, PDO, Tokenizer, XML
-   **Composer** - PHP dependency manager
-   **Node.js 18+** dan **NPM** - Frontend build tools
-   **MySQL 8.0+** - Database server
-   **Git** - Version control

### **🔧 Step-by-Step Installation**

#### **1. Clone Repository**

```bash
git clone https://github.com/your-username/incident-report.git
cd incident-report
```

#### **2. Install PHP Dependencies**

```bash
composer install
```

#### **3. Install Frontend Dependencies**

```bash
npm install
```

#### **4. Environment Configuration**

```bash
cp .env.example .env
php artisan key:generate
```

#### **5. Database Configuration**

Edit file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=incident_report_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

#### **6. Database Migration & Seeding**

```bash
php artisan migrate --seed
```

#### **7. Build Frontend Assets**

```bash
npm run build
```

#### **8. Start Development Server**

```bash
php artisan serve
```

**🌐 Application akan tersedia di:** `http://127.0.0.1:8000`

## 📊 **Database Setup**

### **🗄️ Database Structure**

#### **Users Table**

-   `id` - Primary key
-   `name` - Nama lengkap
-   `email` - Email unik
-   `password` - Encrypted password
-   `role` - Enum: 'admin', 'user'
-   `created_at`, `updated_at` - Timestamps

#### **Reports Table**

-   `id` - Primary key
-   `nama_pelapor` - Nama pelapor
-   `nomor_whatsapp` - Nomor WhatsApp
-   `departemen` - Departemen pelapor
-   `nik` - Nomor Induk Karyawan
-   `keterangan` - Detail kejadian
-   `foto` - Path foto pendukung
-   `status` - Enum: 'baru', 'proses', 'selesai'
-   `created_at`, `updated_at` - Timestamps

### **🔄 Migration Commands**

```bash
# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Fresh migration with seeding
php artisan migrate:fresh --seed
```

## 👥 **User Accounts**

### **🔑 Default Accounts**

Setelah menjalankan seeder, akun default tersedia:

#### **Admin Account**

```
Email: admin@incident-report.com
Password: admin123
Role: Admin
Access: Full system access
```

#### **User Account**

```
Email: user@incident-report.com
Password: user123
Role: User
Access: Report creation only
```

### **👤 User Roles**

#### **Admin Role**

-   ✅ **Dashboard Access** - View all reports
-   ✅ **Report Management** - View, update status
-   ✅ **Excel Export** - Export reports data
-   ✅ **User Management** - Manage users
-   ✅ **System Settings** - Configure system

#### **User Role**

-   ✅ **Report Creation** - Submit incident reports
-   ✅ **Profile Management** - Update personal info
-   ❌ **Admin Access** - No admin privileges
-   ❌ **Export Access** - No export functionality

## 🎨 **UI/UX Design**

### **🎨 Design Principles**

-   **Monochrome Theme** - Professional gray color scheme
-   **Minimalist Approach** - Clean dan uncluttered interface
-   **Responsive Design** - Mobile-first responsive layout
-   **Accessibility** - WCAG compliant design
-   **User Experience** - Intuitive navigation

### **🎯 Color Palette**

-   **Primary**: Gray-800 (#1F2937)
-   **Secondary**: Gray-600 (#4B5563)
-   **Background**: Gray-50 (#F9FAFB)
-   **Text**: Gray-900 (#111827)
-   **Borders**: Gray-200 (#E5E7EB)

### **📱 Responsive Breakpoints**

-   **Mobile**: < 640px
-   **Tablet**: 640px - 1024px
-   **Desktop**: > 1024px

## 📁 **Project Structure**

```
incident_report/
├── app/
│   ├── Exports/              # Excel export classes
│   │   └── ReportsExport.php
│   ├── Http/
│   │   ├── Controllers/      # Application controllers
│   │   │   ├── AdminController.php
│   │   │   └── ReportController.php
│   │   ├── Middleware/      # Custom middleware
│   │   │   └── AdminMiddleware.php
│   │   └── Requests/        # Form request validation
│   └── Models/              # Eloquent models
│       ├── Report.php
│       └── User.php
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   ├── views/              # Blade templates
│   │   ├── admin/          # Admin views
│   │   ├── auth/           # Authentication views
│   │   └── reports/        # Report views
│   ├── css/                # Stylesheets
│   └── js/                 # JavaScript files
├── routes/
│   ├── web.php            # Web routes
│   └── auth.php           # Authentication routes
├── storage/                # File storage
├── tests/                  # Test files
├── composer.json          # PHP dependencies
├── package.json           # Node.js dependencies
└── README.md             # This file
```

## 🔧 **Configuration**

### **⚙️ Environment Variables**

#### **Database Configuration**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=incident_report_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

#### **Application Configuration**

```env
APP_NAME="Incident Report System"
APP_ENV=local
APP_KEY=base64:your_app_key
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
```

#### **File Storage Configuration**

```env
FILESYSTEM_DISK=local
```

### **🔐 Security Configuration**

#### **Session Configuration**

```env
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null
```

#### **CSRF Protection**

-   ✅ **CSRF Tokens** - All forms protected
-   ✅ **XSS Protection** - Input sanitization
-   ✅ **SQL Injection** - Eloquent ORM protection

## 🧪 **Testing**

### **🔬 Running Tests**

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=AdminTest

# Run with coverage
php artisan test --coverage
```

### **📊 Test Coverage**

-   **Unit Tests** - Model dan service testing
-   **Feature Tests** - End-to-end functionality
-   **Integration Tests** - API dan database testing

## 📦 **Deployment**

### **🚀 Production Deployment**

#### **1. Server Requirements**

-   **PHP 8.2+** dengan required extensions
-   **MySQL 8.0+** atau **PostgreSQL**
-   **Nginx** atau **Apache** web server
-   **SSL Certificate** untuk HTTPS

#### **2. Deployment Steps**

```bash
# Clone repository
git clone https://github.com/your-username/incident-report.git

# Install dependencies
composer install --optimize-autoloader --no-dev

# Build assets
npm run build

# Configure environment
cp .env.example .env
# Edit .env with production values

# Generate key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### **3. Web Server Configuration**

**Nginx Configuration:**

```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/incident_report/public;

    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### **🔒 Security Considerations**

-   ✅ **HTTPS Only** - SSL/TLS encryption
-   ✅ **Environment Protection** - .env file security
-   ✅ **File Permissions** - Proper file permissions
-   ✅ **Database Security** - Secure database credentials
-   ✅ **Regular Updates** - Keep dependencies updated

## 🤝 **Contributing**

### **📝 Contribution Guidelines**

1. **Fork** repository
2. **Create** feature branch (`git checkout -b feature/amazing-feature`)
3. **Commit** changes (`git commit -m 'Add amazing feature'`)
4. **Push** to branch (`git push origin feature/amazing-feature`)
5. **Open** Pull Request

### **🔧 Development Setup**

```bash
# Install development dependencies
composer install --dev

# Run development server
php artisan serve

# Watch for changes
npm run dev
```

### **📋 Code Standards**

-   **PSR-12** coding standards
-   **Laravel Pint** for code formatting
-   **PHPUnit** for testing
-   **Clean Architecture** principles

## 📄 **License**

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

## 🆘 **Support**

### **📞 Getting Help**

-   **Documentation**: Check this README
-   **Issues**: Create GitHub issue
-   **Email**: support@incident-report.com

### **🐛 Bug Reports**

When reporting bugs, please include:

-   **Laravel Version**: `php artisan --version`
-   **PHP Version**: `php --version`
-   **Error Logs**: `storage/logs/laravel.log`
-   **Steps to Reproduce**: Detailed steps

### **💡 Feature Requests**

-   **GitHub Issues**: Create feature request
-   **Email**: features@incident-report.com
-   **Documentation**: Include detailed description

---

## 🎉 **Acknowledgments**

-   **Laravel Framework** - Amazing PHP framework
-   **TailwindCSS** - Beautiful utility-first CSS
-   **Maatwebsite Excel** - Excel export functionality
-   **Laravel Breeze** - Authentication scaffolding

---

**🚀 Built with ❤️ using Laravel 12.0**

> **Professional Incident Report Management System** - Clean, Secure, dan User-Friendly
