# COMPANY PROFILE SWABINA GATRA

## Pembimbing lapang
- pak Wawan
- pak Aan

## ketua unit
-Ema kusnadi

## Tim Pengembang
- Vicky Fernando A.P.I / [https://github.com/Vckynando12](https://github.com/Vckynando12)

## Panduan Penggunaan

1. Clone repositori ini ke server lokal Anda.
    ```bash
    git clone <repository_url>
    ```

2. Masuk ke direktori proyek.
    ```bash
    cd <project_folder>
    ```

3. Instal dependensi dengan Composer.
    ```bash
    composer install
    ```

4. Salin file `.env.example` menjadi `.env` dan atur konfigurasi database.
    ```bash
    cp .env.example .env
    ```

5. Generate kunci aplikasi untuk `.env`.
    ```bash
    php artisan key:generate
    ```

6. Buat symbolic link untuk folder `storage`.
    ```bash
    php artisan storage:link
    ```

7. Buat folder untuk menyimpan gambar carousel dan foto layanan.
    ```bash
    mkdir -p storage/app/public/carousels
    ```
    ```bash
    mkdir -p storage/app/public/foto-layanan
    ```

8. Jalankan migrasi database.
    ```bash
    php artisan migrate
    ```

9. Seed data ke dalam tabel `users` menggunakan seeder `UsersTableSeeder`.
    ```bash
    php artisan db:seed --class=UsersTableSeeder
    ```

10. Atau gunakan seeder `UserSeeder` untuk seeding database.
    ```bash
    php artisan db:seed --class=UserSeeder
    ```

11. Jalankan server lokal.
    ```bash
    php artisan serve
    ```

12. Buka aplikasi di browser dengan alamat yang muncul pada terminal, contoh URL: [http://localhost:8000](http://localhost:8000).

## Kontribusi

Kami menyambut kontribusi dari siapa saja yang ingin berpartisipasi dalam pengembangan proyek ini. Jika Anda ingin berkontribusi, silakan buat pull request dan kami akan meninjau kontribusi Anda.

Terima kasih telah berkontribusi pada proyek ini!
