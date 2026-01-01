DolphiDay 🌊

Your gentle companion for building meaningful habits

DolphiDay adalah aplikasi web yang membantu Anda membangun kebiasaan kecil yang bermakna dengan pendekatan yang lembut, reflektif, dan tidak menghakimi. Kami percaya bahwa pertumbuhan dimulai dari kehadiran, bukan kesempurnaan.

🎯 Tentang DolphiDay
DolphiDay dirancang untuk mereka yang ingin membangun kebiasaan positif tanpa tekanan streak atau target yang kaku. Aplikasi ini memberikan ruang untuk:

Melangkah dengan lembut - Fokus pada micro actions yang mudah dilakukan
Merefleksikan perjalanan - Mencatat growth logs dengan mood tracking
Tumbuh tanpa tekanan - Tidak ada streak yang membuat cemas
Menghargai prosesnya - Setiap langkah kecil adalah pencapaian


✨ Fitur Utama
Untuk Pengguna
🎯 Micro Actions

Buat action kecil yang mudah dicapai
Tandai sebagai selesai kapan saja
Lihat riwayat pencapaian mingguan
Edit atau hapus action sesuai kebutuhan

📝 Growth Logs

Tulis refleksi harian Anda
Pilih mood: peaceful, hopeful, content, growing, atau struggling
Lihat timeline perjalanan pertumbuhan
Mood calendar untuk tracking emosi

👤 Profile Management

Update informasi profil
Upload avatar personal
Dashboard yang dipersonalisasi

Untuk Admin
📊 Dashboard Monitoring

Statistik pengguna aktif
Total micro actions yang dibuat
Tingkat penyelesaian keseluruhan
Insight tentang aktivitas pengguna

👥 User Management

Lihat daftar semua pengguna
Akses detail profil pengguna (read-only)
Monitor aktivitas dan progress


🎨 Filosofi Design
DolphiDay menggunakan pendekatan Ocean Therapy dalam desainnya:

Warna lembut - Palet ocean, sky, coral, dan peach yang menenangkan
Rounded corners - Bentuk organik yang ramah
Tipografi friendly - Fredoka untuk header, DM Sans untuk body
Pesan mendukung - Bahasa yang encouraging, bukan judgmental


"Presence over Performance | Growth over Goals | Gentle over Grinding"


🚀 Instalasi
Prasyarat
Pastikan sistem Anda sudah terinstall:

PHP >= 8.2
Composer
Node.js & NPM
PostgreSQL
Git

Langkah Instalasi

Clone Repository

bash   git clone https://github.com/username/dolphiday.git
   cd dolphiday

Install Dependencies

bash   composer install
   npm install

Environment Setup

bash   cp .env.example .env
   php artisan key:generate
```

4. **Konfigurasi Database**
   
   Edit file `.env` dan sesuaikan dengan database PostgreSQL Anda:
```
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=dolphiday
   DB_USERNAME=your_username
   DB_PASSWORD=your_password

Setup Database

bash   php artisan migrate
   php artisan db:seed --class=AdminSeeder

Create Storage Link

bash   php artisan storage:link

Build Assets

bash   npm run dev

Jalankan Aplikasi

bash   php artisan serve

Akses Aplikasi
Buka browser dan kunjungi: http://localhost:8000

Akun Default
Admin Account:

Email: admin@dolphiday.com
Password: password

User Account:

Silakan registrasi melalui halaman /register


💡 Cara Menggunakan
Untuk Pengguna Baru

Registrasi - Buat akun baru di /register
Setup Profile - Upload avatar dan lengkapi profil Anda
Buat Micro Action - Mulai dengan 1-3 action kecil yang ingin Anda lakukan
Check-in Harian - Tandai action yang sudah selesai
Refleksi - Tulis growth log untuk merekam perjalanan Anda

Untuk Admin

Login dengan akun admin
Monitor Dashboard - Lihat statistik keseluruhan
Kelola Users - Lihat dan monitor aktivitas pengguna
Review Activity - Pantau tingkat engagement dan completion rate


🌟 Mengapa DolphiDay?
Perbedaan dengan Habit Tracker Lainnya
AspekHabit Tracker LainDolphiDayPendekatanTarget & StreakPresence & ReflectionPressureTinggi (jangan putus streak!)Rendah (hadir saja cukup)FokusKuantitasKualitas pengalamanToneMotivationalCompassionateGoalAchieve perfectionEmbrace progress
Untuk Siapa DolphiDay?
✨ Ideal untuk:

Orang yang mudah overwhelmed dengan habit tracking tradisional
Mereka yang ingin fokus pada kesehatan mental
Individu yang menghargai refleksi dan mindfulness
Siapa saja yang ingin tumbuh dengan lembut

❌ Mungkin tidak cocok untuk:

Mereka yang butuh kompetisi dan gamification
Yang mencari tracker dengan banyak integrasi dan automasi
Pengguna yang lebih suka pendekatan hard discipline


🛡️ Keamanan & Privacy

Password hashing dengan bcrypt
CSRF protection di semua forms
Session management yang aman
Input validation untuk mencegah injection
Admin read-only - privacy pengguna terjaga


🤝 Kontribusi
Kami menerima kontribusi! Jika Anda ingin berkontribusi:

Fork repository ini
Buat branch untuk fitur Anda (git checkout -b feature/AmazingFeature)
Commit perubahan Anda (git commit -m 'Add some AmazingFeature')
Push ke branch (git push origin feature/AmazingFeature)
Buat Pull Request


📝 License
Proyek ini dilisensikan di bawah MIT License.

💬 Dukungan
Jika Anda menemui masalah atau memiliki pertanyaan:

Issues: GitHub Issues
Discussions: GitHub Discussions


🙏 Acknowledgments
Terima kasih kepada:

Laravel framework dan komunitasnya
Tailwind CSS untuk sistem design yang powerful
Semua kontributor yang telah membantu mengembangkan DolphiDay

