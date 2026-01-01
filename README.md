DolphiDay

DolphiDay adalah aplikasi web pendamping kebiasaan yang membantu pengguna membangun kebiasaan kecil yang bermakna dengan pendekatan lembut, reflektif, dan tidak menghakimi.
Aplikasi ini tidak menekankan streak atau target kaku. Fokus utama DolphiDay adalah kehadiran, refleksi diri, dan pertumbuhan bertahap melalui micro actions serta catatan refleksi harian.

Prinsip utama:
Langkah kecil lebih berkelanjutan
Refleksi lebih penting dari performa
Progres lebih bernilai daripada kesempurnaan

Gambaran Fitur
Pengguna
Membuat dan mengelola micro actions
Menandai penyelesaian tanpa tekanan waktu
Menulis growth log dengan mood tracking
Melihat progres melalui dashboard personal

Admin
Monitoring aktivitas pengguna
Melihat data micro actions dan growth logs (read-only)
Manajemen pengguna

Cara Clone dan Menjalankan Project
1. Clone Repository

git clone https://github.com/farkhansyahibrahimovic-hansporto/DolphyDay-v1.git

cd DolphiDay-v1

3. Install Dependency

composer install

npm install

5. Setup Environment
   
cp .env.example .env

php artisan key:generate

7. Konfigurasi Database (MySQL)
   
Edit file .env:

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=dolphiday

DB_USERNAME=root

DB_PASSWORD=

6. Migrasi dan Seeder
   
php artisan migrate

php artisan db:seed

8. Build Asset dan Jalankan
   
npm run dev

php artisan serve


Akses aplikasi:
http://localhost:8000

Akun Login (Sesuai Seeder)
Admin Account
(Dibuat oleh AdminSeeder)
Email: admin@dolphiday.com
Password: password
Role: admin

User Account
(Dibuat oleh UserSeeder)
Email: user@example.com
Password: password
Role: user

User ini sudah memiliki:
Beberapa micro actions (selesai dan belum selesai)
Beberapa growth logs dengan berbagai mood
Data contoh untuk keperluan demo dan pengujian

Keamanan Singkat
Password di-hash menggunakan bcrypt
CSRF protection aktif
Validasi input pada form
Admin bersifat CRUD terhadap data pengguna

Lisensi
By Farkhansyah Ibrahimovic
