# Showroom Mobil - Laravel 12 Application

Aplikasi web untuk pendataan mobil showroom yang dibangun menggunakan Laravel 12 dengan database MySQL. Aplikasi ini menyediakan fitur CRUD lengkap untuk manajemen data mobil dan jenis mobil, dilengkapi dengan sistem klasifikasi otomatis berdasarkan kapasitas mesin.

## Fitur Utama

### 🚗 Manajemen Data Mobil
- **CRUD Lengkap**: Tambah, lihat, edit, hapus data mobil
- **Klasifikasi Otomatis**: Sistem otomatis menentukan jenis mobil berdasarkan kapasitas mesin:
  - Kapasitas < 1500 cc: Kapasitas Mesin Kecil
  - Kapasitas 1500-2499 cc: Kapasitas Mesin Menengah  
  - Kapasitas ≥ 2500 cc: Kapasitas Mesin Besar
- **Pencarian**: Cari mobil berdasarkan ID atau merek
- **Pengurutan**: Data diurutkan berdasarkan harga dan kapasitas mesin (descending)

### 📊 Dashboard & Statistik
- Tampilan total mobil dan jenis mobil
- Distribusi mobil per jenis dengan visualisasi yang menarik
- Quick access ke halaman manajemen

### 📁 Export Data
- Export data mobil ke format CSV
- Export data mobil ke format TXT
- Data yang diekspor sudah terurut sesuai kriteria

### 🔐 Autentikasi
- Sistem login/register menggunakan Laravel Breeze
- Proteksi semua halaman dengan middleware auth

## Persyaratan Sistem

- PHP ≥ 8.2
- Composer
- Node.js & NPM
- MySQL ≥ 5.7
- Apache/Nginx web server

## Instalasi

### 1. Clone/Setup Project
```bash
# Jika sudah ada project
cd showroom-mobil

# Atau jika baru clone
git clone <repository-url>
cd showroom-mobil
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
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
DB_DATABASE=showroom_mobil
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Buat Database
```sql
CREATE DATABASE showroom_mobil;
```

### 6. Migrasi & Seeding
```bash
# Jalankan migrasi
php artisan migrate

# Jalankan seeder untuk data sample
php artisan db:seed
```

### 7. Build Assets
```bash
# Compile assets
npm run build

# Atau untuk development
npm run dev
```

### 8. Jalankan Server
```bash
# Jalankan Laravel development server
php artisan serve

# Akses aplikasi di http://localhost:8000
```

## Akun Default

Setelah menjalankan seeder, Anda dapat login dengan:
- **Email**: admin@showroom.com
- **Password**: password

## Struktur Database

### Tabel: `jenis_mobils`
- `id` - Primary key
- `nama_jenis` - Nama jenis mobil (string)
- `created_at`, `updated_at` - Timestamps

### Tabel: `mobils`
- `id` - Primary key
- `merek` - Merek mobil (string)
- `harga` - Harga mobil (decimal 15,2)
- `kapasitas_mesin` - Kapasitas mesin dalam cc (integer)
- `jenis_mobil_id` - Foreign key ke tabel jenis_mobils
- `created_at`, `updated_at` - Timestamps

## API Endpoints

### Authentication Routes
- `GET /login` - Halaman login
- `POST /login` - Proses login
- `POST /logout` - Logout
- `GET /register` - Halaman registrasi
- `POST /register` - Proses registrasi

### Application Routes (Protected)
- `GET /dashboard` - Dashboard utama
- `GET /mobils` - Daftar mobil dengan pencarian
- `GET /mobils/create` - Form tambah mobil
- `POST /mobils` - Simpan mobil baru
- `GET /mobils/{id}` - Detail mobil
- `GET /mobils/{id}/edit` - Form edit mobil
- `PUT /mobils/{id}` - Update mobil
- `DELETE /mobils/{id}` - Hapus mobil
- `GET /mobils/export/csv` - Export CSV
- `GET /mobils/export/txt` - Export TXT

### Jenis Mobil Routes
- `GET /jenis-mobils` - Daftar jenis mobil
- `GET /jenis-mobils/create` - Form tambah jenis
- `POST /jenis-mobils` - Simpan jenis baru
- `GET /jenis-mobils/{id}` - Detail jenis
- `GET /jenis-mobils/{id}/edit` - Form edit jenis
- `PUT /jenis-mobils/{id}` - Update jenis
- `DELETE /jenis-mobils/{id}` - Hapus jenis

## Validasi Input

### Mobil
- `merek`: Required, string, max 255 karakter
- `harga`: Required, numeric, minimal 0
- `kapasitas_mesin`: Required, integer, minimal 1

### Jenis Mobil
- `nama_jenis`: Required, string, max 255 karakter, unique

## Fitur Teknis

### Model Events
- **Auto-classification**: Otomatis menentukan jenis mobil saat create/update berdasarkan kapasitas mesin
- **Model Observers**: Menggunakan Eloquent events untuk logika bisnis

### Relationships
- **JenisMobil hasMany Mobil**
- **Mobil belongsTo JenisMobil**

### Blade Components
- Menggunakan komponen Breeze untuk layout yang konsisten
- Responsive design dengan Tailwind CSS
- Form validation dengan error handling

### Security Features
- CSRF protection pada semua form
- Mass assignment protection dengan fillable properties
- SQL injection protection dengan Eloquent ORM
- XSS protection dengan Blade templating

## Testing

### Manual Testing
1. **Authentication**: Test login/logout/register
2. **CRUD Mobil**: Test semua operasi CRUD
3. **CRUD Jenis**: Test semua operasi CRUD
4. **Search**: Test pencarian mobil
5. **Export**: Test download CSV dan TXT
6. **Classification**: Test klasifikasi otomatis dengan berbagai kapasitas mesin

### Sample Test Cases
```bash
# Test dengan data berikut:
- Mobil kapasitas 1200cc → Harus masuk "Kapasitas Mesin Kecil"
- Mobil kapasitas 1800cc → Harus masuk "Kapasitas Mesin Menengah"  
- Mobil kapasitas 3000cc → Harus masuk "Kapasitas Mesin Besar"
```

## Troubleshooting

### Error "Class not found"
```bash
composer dump-autoload
```

### Error Database Connection
- Pastikan MySQL service berjalan
- Cek kredensial database di `.env`
- Pastikan database sudah dibuat

### Assets tidak termuat
```bash
npm run build
php artisan config:clear
```

### Permission Error
```bash
sudo chown -R www-data:www-data storage/
sudo chown -R www-data:www-data bootstrap/cache/
```

## Kontribusi

1. Fork repository
2. Buat feature branch (`git checkout -b feature/nama-fitur`)
3. Commit changes (`git commit -am 'Tambah fitur baru'`)
4. Push ke branch (`git push origin feature/nama-fitur`)
5. Buat Pull Request

## Teknologi yang Digunakan

- **Backend**: Laravel 12, PHP 8.2+
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **Build Tools**: Vite
- **Package Manager**: Composer, NPM

## Lisensi

Aplikasi ini dibuat untuk keperluan pembelajaran dan pengembangan. Silakan gunakan dan modifikasi sesuai kebutuhan.

---

**Dibuat dengan ❤️ menggunakan Laravel 12**
# uji-kompetensi-JWP-2025
