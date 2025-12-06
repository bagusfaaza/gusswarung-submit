## Installation Guide

1. Clone repository:
   ```bash
   git clone https://github.com/dika-maulidal/gus-warung.git
   ```
2. Masuk ke folder project:
   ```bash
   cd gus-warung
   ```

3. (Opsional) Jika composer error, jalankan:
   ```bash
   composer clear-cache
   ```

4. Install dependencies:
   ```bash
   composer install
   ```

5. Copy file environment:
   ```bash
   cp .env.example .env
   ```

6. Edit file `.env` sesuai konfigurasi database.

7. Generate application key:
   ```bash
   php artisan key:generate
   ```

8. Clear config cache:
   ```bash
   php artisan config:clear
   ```

9. Jalankan migrasi database:
   ```bash
   php artisan migrate
   ```

10. Jalankan seeder:
   ```bash
   php artisan db:seed
   ```

---

Project siap dijalankan 🎉
