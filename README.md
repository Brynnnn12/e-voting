<p align="center">
    <img src="https://img.icons8.com/fluency/96/000000/ballot-box-with-ballot.png" width="120" alt="SisVo Logo">
</p>

<h1 align="center">🗳️ SisVo Online - Sistem Voting Digital</h1>

<p align="center">
    <strong>Platform voting online yang aman, modern, dan user-friendly</strong>
</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
<img src="https://img.shields.io/badge/PHP-8.1+-blue.svg" alt="PHP Version">
<img src="https://img.shields.io/badge/Laravel-10.x-red.svg" alt="Laravel Version">
</p>

## 📖 Tentang SisVo Online

**SisVo Online** adalah sistem voting digital yang dibangun dengan Laravel 10, dirancang khusus untuk memfasilitasi proses pemilihan yang aman, transparan, dan efisien. Platform ini menyediakan solusi lengkap untuk berbagai jenis pemilihan mulai dari pemilihan umum, organisasi, hingga komunitas.

### ✨ Fitur Utama

-   🔐 **Keamanan Tinggi** - Sistem enkripsi dan autentikasi berlapis
-   📱 **Responsive Design** - Optimal di desktop, tablet, dan mobile
-   ⚡ **Real-time Updates** - Countdown timer dan status live
-   👥 **Multi-role Management** - Admin dan User dengan akses berbeda
-   📊 **Dashboard Analytics** - Statistik dan laporan lengkap
-   🎨 **Modern UI/UX** - Interface yang intuitif dan menarik
-   🔄 **Real-time Notifications** - Toast notifications untuk feedback instant
-   📋 **Candidate Management** - Kelola kandidat dengan visi-misi
-   🗓️ **Schedule Management** - Atur periode voting dengan fleksibel
-   📈 **Voting Analytics** - Analisis dan visualisasi hasil voting

## 🚀 Teknologi Stack

### Backend

-   **Laravel 10.x** - PHP Framework
-   **MySQL** - Database Management
-   **Spatie Laravel Permission** - Role & Permission Management
-   **Laravel Breeze** - Authentication Scaffolding

### Frontend

-   **Blade Templates** - Server-side Rendering
-   **Tailwind CSS** - Utility-first CSS Framework
-   **Alpine.js** - Lightweight JavaScript Framework
-   **FontAwesome** - Icon Library
-   **Vite** - Frontend Build Tool

### Admin Panel

-   **Filament 3.x** - Modern Admin Panel
-   **Filament Widgets** - Dashboard Components
-   **Filament Forms** - Dynamic Form Builder

## 📋 Persyaratan Sistem

-   PHP >= 8.1
-   Composer
-   Node.js & NPM
-   MySQL >= 5.7 atau PostgreSQL >= 10
-   Web Server (Apache/Nginx)

## 🛠️ Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/your-username/sisvo-online.git
cd sisvo-online
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sisvo_online
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Database Migration & Seeding

```bash
# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed
```

### 6. Storage Setup

```bash
# Create symbolic link for storage
php artisan storage:link
```

### 7. Build Assets

```bash
# Compile assets for development
npm run dev

# Or compile for production
npm run build
```

### 8. Start Development Server

```bash
php artisan serve
```

Aplikasi akan tersedia di `http://localhost:8000`

## 👥 Default Users

Setelah menjalankan seeder, Anda dapat login dengan akun berikut:

### Admin

-   **Email:** admin@sisvo.com
-   **Password:** password

### User

-   **Email:** user@sisvo.com
-   **Password:** password

## 🎯 Penggunaan

### Untuk Admin

1. Login ke sistem menggunakan akun admin
2. Akses admin panel di `/admin`
3. Kelola pemilihan, kandidat, dan user
4. Monitor aktivitas voting real-time
5. Generate laporan dan statistik

### Untuk User

1. Registrasi akun baru atau login
2. Akses dashboard user
3. Lihat pemilihan yang tersedia
4. Pilih kandidat dan submit vote
5. Lihat riwayat voting dan hasil

## 🔧 Konfigurasi

### Role & Permission

Sistem menggunakan Spatie Laravel Permission dengan 2 role utama:

-   **Admin**: Full access ke semua fitur
-   **User**: Akses terbatas untuk voting

### File Upload

Konfigurasi upload file untuk foto kandidat:

```php
// config/filesystems.php
'public' => [
    'driver' => 'local',
    'root' => storage_path('app/public'),
    'url' => env('APP_URL').'/storage',
    'visibility' => 'public',
],
```

## 📊 Fitur Dashboard

### Admin Dashboard

-   📈 **Analytics Charts** - Grafik voting real-time
-   👥 **User Management** - Kelola pengguna sistem
-   🗳️ **Election Management** - Buat dan kelola pemilihan
-   📋 **Candidate Management** - Manajemen kandidat
-   📊 **Reports** - Laporan dan export data

### User Dashboard

-   🎯 **Quick Actions** - Akses cepat ke fitur utama
-   📊 **Personal Stats** - Statistik personal user
-   🕒 **Recent Activity** - Riwayat aktivitas terbaru
-   👤 **Profile Management** - Kelola profil pribadi

## 🎨 UI Components

### Modern Design Elements

-   **Gradient Backgrounds** - Visual yang menarik
-   **Smooth Animations** - Transisi yang halus
-   **Interactive Cards** - Hover effects dan shadows
-   **Toast Notifications** - Feedback real-time
-   **Responsive Layout** - Adaptif semua device

### Custom Components

-   **Countdown Timer** - Timer voting dengan animasi
-   **Candidate Cards** - Kartu kandidat interaktif
-   **Status Indicators** - Indikator status real-time
-   **Progress Bars** - Visualisasi progress

## 🔒 Keamanan

### Fitur Keamanan

-   ✅ **CSRF Protection** - Perlindungan dari CSRF attacks
-   ✅ **SQL Injection Prevention** - Eloquent ORM protection
-   ✅ **XSS Protection** - Input sanitization
-   ✅ **Rate Limiting** - Pembatasan request per menit
-   ✅ **Secure Headers** - Security headers implementation
-   ✅ **Password Hashing** - Bcrypt password hashing
-   ✅ **Session Security** - Secure session management

### Audit Trail

-   📝 Log semua aktivitas voting
-   🕒 Timestamp semua operasi
-   👤 User identification tracking
-   📊 Activity monitoring

## 📱 Responsive Design

Aplikasi dioptimalkan untuk berbagai device:

-   💻 **Desktop** - Full features dengan sidebar layout
-   📱 **Mobile** - Simplified navigation dengan mobile menu
-   📱 **Tablet** - Adaptive grid layout
-   🖥️ **Large Screens** - Extended layout untuk monitor besar

## 🧪 Testing

```bash
# Run unit tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run tests with coverage
php artisan test --coverage
```

## 📦 Build & Deployment

### Production Build

```bash
# Install production dependencies
composer install --optimize-autoloader --no-dev

# Build assets for production
npm run build

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Environment Configuration

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
```

## 🤝 Contributing

Kami menyambut kontribusi dari komunitas! Silakan ikuti langkah berikut:

1. Fork repository ini
2. Buat branch untuk fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

### Development Guidelines

-   Ikuti PSR-12 coding standards
-   Tulis unit tests untuk fitur baru
-   Update dokumentasi sesuai perubahan
-   Gunakan conventional commit messages

## 📝 License

Proyek ini dilisensikan under MIT License - lihat file [LICENSE](LICENSE) untuk detail.

## 🙏 Acknowledgments

-   [Laravel](https://laravel.com) - PHP Framework yang luar biasa
-   [Filament](https://filamentphp.com) - Admin panel yang powerful
-   [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS framework
-   [Alpine.js](https://alpinejs.dev) - JavaScript framework yang ringan
-   [FontAwesome](https://fontawesome.com) - Icon library terlengkap

## 📞 Support

Jika Anda mengalami masalah atau memiliki pertanyaan:

-   📧 Email: support@sisvo-online.com
-   💬 Discord: [SisVo Community](https://discord.gg/sisvo)
-   🐛 Issues: [GitHub Issues](https://github.com/your-username/sisvo-online/issues)
-   📚 Documentation: [Wiki](https://github.com/your-username/sisvo-online/wiki)

---

<p align="center">
    <strong>Dibuat dengan ❤️ untuk demokrasi digital yang lebih baik</strong>
</p>

<p align="center">
    <sub>© 2025 SisVo Online. Semua hak cipta dilindungi.</sub>
</p>
