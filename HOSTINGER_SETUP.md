# Setup untuk Deployment di Hostinger

## 📋 Struktur Folder di Hostinger

```
/home/username/
├── public_html/              ← Folder website yang accessible
│   ├── index.php
│   ├── assets-front/         ← Upload folder untuk gambar settings
│   │   └── settings/
│   └── ... (public files)
├── laravel-app/              ← Root Laravel project (bukan di public_html)
│   ├── app/
│   ├── config/
│   ├── public/               ← Bukan folder ini yang dibaca (bukan di web)
│   ├── storage/
│   ├── resources/
│   └── .env
```

## 🔧 Langkah Setup

### 1. **Konfigurasi .env di Hostinger**

```env
APP_NAME=BeritaRohul
APP_ENV=production
APP_KEY=base64:... (generate dulu)
APP_DEBUG=false
APP_URL=https://beritarohul.id

# Database
DB_CONNECTION=mysql
DB_HOST=your_hostinger_db_host
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

### 2. **Setup via cPanel/Hostinger File Manager**

#### Opsi A: Jika Anda memiliki SSH Access (Recommended)

```bash
# Login via SSH ke Hostinger
ssh username@yourdomain.com

# 1. Buat folder untuk Laravel di luar public_html
cd /home/username
mkdir -p laravel-app
cd laravel-app

# 2. Upload/clone project Laravel ke sini
git clone https://github.com/azizrahmansyah21-web/BeritaRohul.id .

# 3. Buat folder assets di public_html
mkdir -p /home/username/public_html/assets-front/settings
chmod 755 /home/username/public_html/assets-front
chmod 755 /home/username/public_html/assets-front/settings

# 4. Setup environment
cp .env.example .env
php artisan key:generate

# 5. Update path di config/filesystems.php (lihat langkah 3)
# 6. Jalankan migrations
php artisan migrate

# 7. Install dependencies
composer install --optimize-autoloader --no-dev
npm install && npm run build
```

#### Opsi B: Jika Tidak Ada SSH Access (Menggunakan File Manager)

1. Upload project ke folder baru di `/home/username/laravel-app`
2. Buat folder `/home/username/public_html/assets-front/settings`
3. Set permission ke 755 untuk kedua folder
4. Configure `.env` file

### 3. **Update config/filesystems.php**

Ubah bagian 'assets-front' menjadi path absolut yang sesuai Hostinger:

```php
'assets-front' => [
    'driver' => 'local',
    'root' => dirname(__DIR__, 1) . '/../public_html/assets-front',  // Relatif ke folder Laravel
    'url' => env('APP_URL') . '/assets-front',
    'visibility' => 'public',
    'throw' => false,
],
```

Atau lebih aman, gunakan environment variable:

```php
'assets-front' => [
    'driver' => 'local',
    'root' => env('ASSETS_FRONT_PATH', public_path('assets-front')),
    'url' => env('APP_URL') . '/assets-front',
    'visibility' => 'public',
    'throw' => false,
],
```

Dan tambahkan di `.env`:

```env
ASSETS_FRONT_PATH=/home/username/public_html/assets-front
```

### 4. **Setup Symbolic Link (Optional tapi Recommended)**

Di `.env` tambahkan:

```env
STORAGE_SYMLINK=true
```

Lalu jalankan:

```bash
php artisan storage:link
```

### 5. **Pastikan Permission Folder**

```bash
# Permission untuk write
chmod 777 /home/username/public_html/assets-front/settings
chmod 777 /home/username/laravel-app/storage
chmod 777 /home/username/laravel-app/bootstrap/cache
```

## ✅ Verifikasi

1. **Cek file disimpan dengan benar:**
   - Upload logo/favicon
   - Cek di `/home/username/public_html/assets-front/settings/`
   - Harus ada file gambar baru

2. **Cek URL accessible:**
   - Buka `https://beritarohul.id/assets-front/settings/[filename]`
   - Gambar harus tampil di browser

3. **Cek database:**
   - Kolom `logo` dan `favicon` harus berisi: `settings/[filename]`

## 🚨 Troubleshooting

### Gambar tidak ditampilkan
- Periksa permission folder (harus 755 minimum)
- Periksa path di database (harus benar)
- Cek .env `APP_URL` (harus dengan https)

### Error "Permission denied"
- Jalankan: `chmod 755 storage bootstrap/cache public/assets-front`

### File tidak tersimpan
- Periksa disk 'assets-front' di `config/filesystems.php`
- Pastikan folder destination ada
- Cek error log di `storage/logs/`

## 📝 Catatan Penting

- **Jangan** ubah index.php atau bootstrap/app.php yang berada di folder Laravel, itu bukan entry point
- Entry point di Hostinger adalah file di `public_html/`
- Struktur publik ada di `public/` (dalam folder Laravel), tapi folder `assets-front` kami letakkan di `public_html/` langsung
- Backup `.env` file di tempat aman (jangan push ke repo)
