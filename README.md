# 🖌️ NailArt-Web

Aplikasi web e-commerce untuk layanan **Nail Art** dengan fitur katalog produk, gallery desain, manajemen pesanan, dan admin panel lengkap.

---

## 🚀 Quick Start

### Prerequisites
- PHP 7.4+
- MySQL 5.7+
- Composer
- CodeIgniter 4

### Setup

```bash
# 1. Clone repository
git clone <repo-url>

# 2. Install dependencies
composer install

# 3. Database setup
- Buka phpMyAdmin
- Buat database: db_nailart
- Import: app/Database/db_nailart.sql

# 4. Start server
php spark serve

# 5. Akses aplikasi
- Frontend: http://localhost:8080
- Admin:    http://localhost:8080/admin/dashboard
```

### Default Login
```
Admin:
Username: admin
Password: admin123
```

---

## 🌟 Fitur Utama

### Frontend User
- 🎨 **Accessories** - Katalog produk nail art
- 🖼️ **Gallery** - Inspirasi desain nail art
- 💅 **Models** - Portfolio nail artist
- 🛒 **Shopping Cart** - Keranjang dengan localStorage/database
- 👤 **Profile** - Edit profil & foto user
- 📦 **Checkout** - Proses pembelian dengan tanggal & total

### Admin Panel
- 📊 **Dashboard** - Ringkasan statistik (Accessories, Models, Gallery, Users, Checkout)
- 🖼️ **Gallery Management** - CRUD galeri foto
- 💅 **Models Management** - CRUD portfolio model
- 🏷️ **Accessories Management** - CRUD katalog produk
- 👥 **Users Management** - CRUD data user
- 📦 **Checkout Management** - Lihat transaksi & detail pesanan

---

## 📁 Struktur Folder

```
NailArt-Web/
├── app/
│   ├── Controllers/
│   │   ├── Home.php (Frontend + Cart + Checkout)
│   │   ├── Auth.php (Login/Logout)
│   │   └── Admin.php (Admin CRUD)
│   ├── Models/
│   │   ├── UserModel.php
│   │   ├── AccessoriesModel.php
│   │   ├── ModelsModel.php
│   │   ├── GalleryModel.php
│   │   ├── KeranjangModel.php
│   │   ├── CheckoutModel.php
│   │   └── DetailCheckoutModel.php
│   ├── Views/
│   │   ├── index.php (Home)
│   │   ├── accessoris.php
│   │   ├── gallery.php
│   │   ├── models.php
│   │   ├── keranjang.php (Shopping Cart)
│   │   ├── profil.php (User Profile)
│   │   ├── daftar.php (Register)
│   │   ├── about.php
│   │   ├── layout/
│   │   │   ├── template.php
│   │   │   └── admin_template.php
│   │   └── admin/
│   │       ├── dashboard_admin.php
│   │       ├── gallery_management.php
│   │       ├── models_management.php
│   │       ├── accessories_management.php
│   │       ├── users_management.php
│   │       └── checkout_management.php
│   └── Database/
│       ├── db_nailart.sql
│       ├── Migrations/
│       └── Seeds/
├── public/
│   ├── assets/
│   │   └── (CSS, JS, images)
│   └── uploads/
│       ├── accessories/
│       ├── gallery/
│       ├── models/
│       └── users/
├── tests/ (Unit tests)
└── writable/ (Cache, logs, uploads)
```

---

## 💻 Key Features

### Smart Shopping Cart
- **Guest Mode**: Data disimpan di localStorage
- **User Mode**: Data disimpan di database (saat login)
- **Real-time Badge**: Jumlah item update otomatis
- **Persistent**: Data tetap setelah logout/login

### Checkout System
- Capture date/time otomatis
- Simpan informasi user (username, alamat)
- Tampilkan summary dengan total harga
- Admin bisa lihat semua transaksi

### Security
- ✅ CSRF token protection
- ✅ Input validation & escaping
- ✅ Password hashing
- ✅ Role-based access control
- ✅ Login required untuk checkout

### User Experience
- 🎨 Modern Tailwind CSS design
- 📱 Responsive di semua device
- ✨ SweetAlert2 untuk notifications
- 🚀 AJAX untuk operasi tanpa page reload
- 🖼️ Image optimization & lazy loading

---

## 📊 Database Schema

### Tables
- **user** - Data user (username, password, alamat, gambar_user, role)
- **accessories** - Katalog produk
- **models** - Portfolio nail artist
- **gallery** - Galeri inspirasi
- **keranjang** - Shopping cart (temporary untuk guest, persistent untuk user)
- **checkout** - Transaksi (id_user, total_harga, tanggal_checkout)
- **detail_checkout** - Detail item checkout (id_checkout, id_produk, jumlah_checkout, harga_checkout)

---

## 🔧 Teknologi

- **Backend**: PHP 7.4+, CodeIgniter 4
- **Database**: MySQL 5.7+
- **Frontend**: HTML5, CSS3 (Tailwind), JavaScript (ES6+)
- **Libraries**: 
  - SweetAlert2 (Alerts & notifications)
  - Font Awesome (Icons)
  - Kint (Debugging - dev only)
  - PHPUnit (Testing)

---

## 📖 API Routes

### Frontend Routes
```
GET  /                    → Home
GET  /accessoris          → Accessories catalog
GET  /gallery             → Gallery
GET  /models              → Models portfolio
GET  /keranjang           → Shopping cart
GET  /profil              → User profile
POST /profil/update       → Update profile
POST /checkout/process    → Process checkout
GET  /daftar              → Register page
POST /register/save       → Save new user
POST /login/auth          → Login
GET  /logout              → Logout
```

### Admin Routes
```
GET  /admin/dashboard     → Dashboard
GET  /admin/gallery       → Gallery management
POST /admin/saveGallery   → Save gallery
GET  /admin/models        → Models management
POST /admin/saveModels    → Save models
GET  /admin/accessories   → Accessories management
POST /admin/saveAccessories → Save accessories
GET  /admin/users-management → Users management
GET  /admin/checkout      → Checkout management
POST /admin/checkout/detail → Get checkout detail (AJAX)
```

---

## 🧪 Testing

### Manual Testing Checklist
- [ ] Login/Logout works
- [ ] Add to cart works
- [ ] Checkout flow complete
- [ ] Admin can CRUD data
- [ ] Gallery updates on frontend
- [ ] Profile photo upload works
- [ ] Search filters work
- [ ] Responsive on mobile

### Run Unit Tests
```bash
php vendor/bin/phpunit
```

---

## 📝 File Descriptions

| File | Purpose |
|------|---------|
| `db_nailart.sql` | Database schema & sample data |
| `spark` | CodeIgniter CLI tool |
| `composer.json` | PHP dependencies |
| `phpunit.xml.dist` | PHPUnit configuration |
| `.env` | Environment variables (not in repo) |

---

## 🐛 Troubleshooting

### Issue: "Whoops!" error
**Solution**: Check `/writable/logs/` untuk error details

### Issue: Gambar tidak muncul
**Solution**: Upload melalui admin panel atau pastikan `/public/uploads/` writable

### Issue: Keranjang kosong
**Solution**: 
- Guest: Cek localStorage (F12 → Application)
- User: Cek database tabel keranjang

### Issue: Login gagal
**Solution**: Pastikan database sudah diimport dan ada user admin

---

## 📞 Support & Documentation

- **Error Logs**: `/writable/logs/`
- **Database**: Import `app/Database/db_nailart.sql`
- **Config**: Edit `app/Config/` untuk konfigurasi

---

## 📄 License

Private project untuk tugas akhir RPL

---

## 👥 Tim Pengembang

- 👨‍💻 **Ahmad Reza Aulia Siregar** - Programmer
- 📊 **Riska Khairani Nasution** - System Analyst
- 🎨 **Vico Zefanya Hutauruk** - Web Designer
- 🧪 **Muhammad Fattah** - Testing

**Program**: TRPL C 2023