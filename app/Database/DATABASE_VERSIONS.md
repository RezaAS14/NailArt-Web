# 📊 Database Version Comparison

Ada dua versi file database `db_nailart.sql` yang tersedia. Berikut penjelasan perbedaannya:

---

## 📁 File yang Tersedia

### 1. **db_nailart.sql (dengan data)**
📍 Lokasi: `app/Database/ini yg sudah ada datanya/db_nailart.sql`

### 2. **db_nailart.sql (tanpa data - POLOS)**
📍 Lokasi: `app/Database/ini yg belum ada datanya (POLOS)/db_nailart.sql`

---

## 🔍 Perbedaan Detail

### A. Data di Tabel

| Tabel | Dengan Data | Tanpa Data (POLOS) |
|-------|-------------|-------------------|
| **accessories** | ✅ 6 produk lengkap | ❌ Kosong (hanya struktur) |
| **gallery** | ✅ 8 foto | ❌ Kosong (hanya struktur) |
| **models** | ✅ 24 model nail art | ❌ Kosong (hanya struktur) |
| **keranjang** | ✅ 2 item sampel | ❌ Kosong (hanya struktur) |
| **user** | ✅ Admin + 1 user (reza) | ✅ Admin + 1 user tes |
| **checkout** | ❌ Kosong | ❌ Kosong |
| **detail_checkout** | ❌ Kosong | ❌ Kosong |

---

### B. Data Produk (Accessories)

#### Dengan Data - Berisi 6 Produk:
```
1. NAIL FILE - Rp 90,800 (diskon 12%)
2. CUTICLE PUSHER - Rp 30,000 (diskon 10%)
3. CUTICLE NIPPER - Rp 115,000 (diskon 20%)
4. NAIL BRUSH - Rp 58,000 (diskon 50%)
5. BASE COAT - Rp 78,960 (diskon 50%)
6. TOP COAT - Rp 149,950 (diskon 80%)
```

#### Tanpa Data - Kosong (Hanya struktur tabel)

---

### C. Data Gallery

#### Dengan Data - Berisi 8 Foto:
```
1. Nail art elegan dengan warna natural
2. Desain kuku modern warna maroon gelap
3. Kuku motif marmer tampak elegan
4. Nail art glossy dengan nuansa biru
5. Desain kuku marmer kombinasi cantik
6. Nail art silver glitter dengan motif bunga & pita
7. Nail art abstrak biru lembut
8. Kuku gel merah elegan mengkilap seperti mawar
```

#### Tanpa Data - Kosong (Hanya struktur tabel)

---

### D. Data Models

#### Dengan Data - Berisi 24 Model:
- **8 Model Easy** (Rp 65,000 - 70,000, durasi 1 jam)
- **8 Model Medium** (Rp 90,000 - 120,000, durasi 1.5 jam)
- **8 Model Hard** (Rp 150,000 - 250,000, durasi 2 - 5 jam)

#### Tanpa Data - Kosong (Hanya struktur tabel)

---

### E. Data User

#### Dengan Data - Ada 2 User:
```
Admin:
- ID: 1
- Username: admin
- Password: admin123
- Email: admin@gmail.com

User Contoh:
- ID: 2
- Username: tes
- Nama: Test User
- Email: tes@gmail.com
- Password: tes1234
```

#### Tanpa Data (POLOS) - Ada 2 User:
```
Admin:
- ID: 1
- Username: admin
- Password: admin123
- Email: admin@gmail.com

User Test:
- ID: 2
- Username: tes
- Nama: Test User
- Password: tes1234
- Email: tes@gmail.com
```

---

### F. Data Keranjang

#### Dengan Data - Berisi 2 Item:
```
- User 2 (reza) -> Produk 1 (Nail File) -> Qty 1
- User 2 (reza) -> Produk 2 (Cuticle Pusher) -> Qty 1
```

#### Tanpa Data - Kosong

---

## 🛠️ Kapan Menggunakan Masing-masing?

### ✅ Gunakan **Dengan Data** Jika:
- 🧪 **Testing/Demo** - Ingin langsung lihat aplikasi berjalan dengan data lengkap
- 👀 **Presentasi** - Menampilkan fitur aplikasi ke stakeholder
- 📸 **Screenshot** - Mengambil gambar untuk dokumentasi
- 🚀 **Versi Beta** - Produksi pertama dengan data sampel

### ✅ Gunakan **Tanpa Data (POLOS)** Jika:
- 🏗️ **Development** - Setup development environment bersih
- 📚 **Tutorial** - Belajar sambil menambah data sendiri
- 🔄 **Reset** - Ingin membersihkan database dari sampel data
- 📦 **Production** - Deploy ke server production tanpa data sampel

---

## 📋 Tabel Struktur (Sama di Kedua Versi)

### accessories
```
- id_produk (PK, AUTO_INCREMENT)
- gambar_produk (varchar 128)
- nama_produk (varchar 25)
- harga_produk (decimal 12,2)
- diskon (decimal 5,2, default 0)
- deskripsi_produk (text)
- stok_tersedia (int, default 0)
```

### checkout
```
- id_checkout (PK, AUTO_INCREMENT)
- id_user (FK -> user.id_user)
- total_harga (decimal 12,2)
- tanggal_checkout (datetime)
```

### detail_checkout
```
- id_detailco (PK, AUTO_INCREMENT)
- id_checkout (FK -> checkout.id_checkout)
- id_produk (FK -> accessories.id_produk)
- jumlah_checkout (int)
- harga_checkout (decimal 12,2)
```

### gallery
```
- id_gallery (PK, AUTO_INCREMENT)
- gambar_gallery (varchar 128)
- deskripsi_gallery (text)
```

### keranjang
```
- id_keranjang (PK, AUTO_INCREMENT)
- id_user (FK -> user.id_user)
- id_produk (FK -> accessories.id_produk)
- jumlah_keranjang (int)
```

### models
```
- id_models (PK, AUTO_INCREMENT)
- kategori_models (enum: Easy, Medium, Hard)
- gambar_models (varchar 128)
- durasi (decimal 5,2)
- harga_models (decimal 12,2)
```

### user
```
- id_user (PK, AUTO_INCREMENT)
- gambar_user (varchar 128)
- username (varchar 20, UNIQUE)
- nama_depan (varchar 30)
- nama_belakang (varchar 30)
- email (varchar 128, UNIQUE)
- tanggal_lahir (date)
- no_telp (varchar 13)
- alamat (text)
- password (varchar 128)
- role (enum: admin, user, default user)
```

---

## 🚀 Cara Import Database

### Import Versi Dengan Data:
```bash
1. Buka phpMyAdmin
2. Klik "Import"
3. Pilih: app/Database/ini yg sudah ada datanya/db_nailart.sql
4. Klik "Import"
5. ✅ Database siap dengan data sampel
```

### Import Versi Tanpa Data (POLOS):
```bash
1. Buka phpMyAdmin
2. Klik "Import"
3. Pilih: app/Database/ini yg belum ada datanya (POLOS)/db_nailart.sql
4. Klik "Import"
5. ✅ Database siap (struktur kosong)
6. Mulai tambah data via Admin Panel
```

---

## 📊 Ringkasan Tabel Data

| Fitur | Dengan Data | POLOS |
|-------|-------------|-------|
| **Setup Cepat** | ✅ Ya | ❌ Perlu setup data |
| **Demo Ready** | ✅ Ya | ❌ Tidak |
| **Testing** | ✅ Langsung bisa | ⚠️ Perlu tambah data |
| **Development** | ⚠️ Ada sampel data | ✅ Bersih |
| **Production** | ❌ Ada data dummy | ✅ Bersih |
| **Learning** | ✅ Ada contoh | ✅ Belajar sambil membuat |

---

## 💡 Rekomendasi

### 🎯 Untuk Pemula
**→ Gunakan Versi Dengan Data**
- Langsung bisa lihat aplikasi jalan
- Tidak perlu bingung setup data
- Cocok untuk belajar

### 🎯 Untuk Development/Production
**→ Gunakan Versi POLOS**
- Database bersih tanpa dummy data
- Persiapan untuk data real
- Professional setup

### 🎯 Untuk Presentasi/Demo
**→ Gunakan Versi Dengan Data**
- Sudah ada data untuk ditampilkan
- User experience lebih real
- Impressive untuk client

---

## ⚠️ Penting!

1. **Hanya pilih SATU versi** saat import
2. **Jangan import keduanya** (akan error)
3. **Pastikan database kosong** sebelum import
4. **Username & Password** sama di kedua versi
5. **Struktur tabel** identik, hanya data yang berbeda

---

**Last Updated**: December 4, 2025  
**Database Version**: 1.0
