# 🌱 Supplify

**Supplify** adalah aplikasi web marketplace yang mempertemukan **perusahaan** sebagai penjual dengan **UMKM/pengrajin** sebagai pembeli.  
Fokus utama Supplify adalah memfasilitasi penjualan **bahan sisa produksi** yang masih layak dimanfaatkan agar tidak terbuang percuma, sekaligus membantu UMKM mendapatkan bahan baku dengan harga lebih terjangkau.  

---

## 🎯 Tujuan
- Mengurangi limbah produksi dengan memanfaatkan kembali bahan sisa yang masih layak pakai.  
- Membantu UMKM memperoleh bahan baku murah untuk mendukung keberlangsungan usaha.  
- Meningkatkan nilai ekonomi melalui **reuse** dan **upcycle** bahan produksi.  
- Menciptakan ekosistem bisnis yang **berkelanjutan**.  

---

## 🚀 Fitur Utama

### 👥 Pembeli
- Registrasi & Login  
- Manajemen profil  
- Marketplace produk & detail produk  
- Keranjang belanja  
- Checkout & transaksi  
- Riwayat transaksi  

### 🏭 Penjual
- Registrasi & Login  
- Manajemen profil & biodata perusahaan  
- CRUD Produk (Tambah/Edit/Hapus)  
- Status produk (menunggu verifikasi, diterima/ditolak)  
- Riwayat penjualan  

### 🛡️ Admin
- Login dashboard admin  
- Manajemen user (pembeli & penjual)  
- Verifikasi produk  
- Monitoring transaksi  
- Log produk  

---

## 🛠️ Tech Stack
- **Backend**: [Laravel 10](https://laravel.com/) (PHP, MVC)  
- **Frontend**: [Blade](https://laravel.com/docs/blade) + [Tailwind CSS](https://tailwindcss.com/)  
- **Database**: MySQL  
- **Tools**:  
  - Figma (UI/UX Design)  
  - GitHub (Version Control)  
  - XAMPP (PHP & MySQL)  
  - Draw.io / Creately (Diagram)  
  - Google Docs (Dokumentasi)  

---

## ⚡ Instalasi
```bash
# 1. Clone repo
git clone https://github.com/username/supplify.git
cd supplify

# 2. Install dependency
composer install
npm install && npm run dev

# 3. Konfigurasi .env
cp .env.example .env
php artisan key:generate

# 4. Migrasi database
php artisan migrate --seed

# 5. Jalankan server lokal
php artisan serve
```
---

## 👨‍💻 Tim Developer – Kelompok 1
- Aji Pamungkas       - Project Manager & Fullstack
- Dinara Maulida      - Designer
- Faiz Akhrian Putra  - System Analyst
- Kerina Indri Febriany - Front End
- M. Budiono          - QA Tester
- Siti Nur Syafa      - Designer
