# 🏨 *Reservasi Penginapan – Web Application*

Dokumentasi Pengguna & Panduan Instalasi


---

# 🚀 *A. Instalasi & Menjalankan Aplikasi*

Panduan berikut menjelaskan proses instalasi aplikasi Reservasi Penginapan hingga siap dijalankan pada server lokal.

---

## 🔽 *1. Clone Repository*

bash
git clone https://github.com/MaynovaSimamora/Reservasi-Penginapan.git
cd Reservasi-Penginapan


## 📦 *2. Install Dependensi Laravel*

bash
composer install


## 🛠 *3. Menyiapkan File .env*

Jika belum ada file .env, salin dari .env.example kemudian ubah konfigurasi database:

env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=reservasi_hotel
DB_USERNAME=root
DB_PASSWORD=


> *Note:* Sesuaikan database dengan kebutuhan masing-masing.

## ⚡ *4. Menjalankan XAMPP*

Aktifkan layanan:

* Apache
* MySQL

## 🗂 *5. Migrasi Database & Seeder*

bash
php artisan migrate --seed


Perintah ini akan membuat tabel dan mengisi data awal termasuk *akun admin*.

## 🔑 *6. Generate APP_KEY*

bash
php artisan key:generate


## 🔗 *7. Membuat Symlink Storage*

bash
php artisan storage:link


## 🌐 *8. Install Dependensi Frontend*

bash
npm install


## 🔁 *9. Menjalankan Vite*

bash
npm run dev


## ▶ *10. Menjalankan Server Laravel*

bash
php artisan serve


Aplikasi dapat diakses melalui:
👉 *[http://127.0.0.1:8000/](http://127.0.0.1:8000/)*

---

# 📘 *B. Cara Menggunakan Aplikasi Reservasi Penginapan*

Setelah aplikasi dijalankan, pengguna dapat mengakses sistem melalui URL:
*[http://127.0.0.1:8000/](http://127.0.0.1:8000/)*

Dokumentasi berikut menjelaskan alur penggunaan dari sisi *User* dan *Admin*.

---

# 👤 *2.1 Login & Registrasi*

## 🆕 *2.1.1 Registrasi User Baru*

Tampilan: resources/views/auth/register.blade.php

*Langkah-langkah:*

1. Buka halaman utama.
2. Klik *Register*.
3. Isi:

   * Nama
   * Email
   * Password
4. Klik *Register*.

Akun berhasil dibuat dan dapat langsung digunakan untuk login.

---

## 🔐 *2.1.2 Login User atau Admin*

Tampilan: resources/views/auth/login.blade.php

*Akun Admin (Seeder):*

* Email: *[admin@gmail.com](mailto:admin@gmail.com)*
* Password: *admin123*

*Setelah Login:*

* User → diarahkan ke halaman *reservasi*.
* Admin → diarahkan ke halaman *Kelola Kamar* (/admin/rooms).

---

# 🛏 *2.2 Menggunakan Aplikasi sebagai User*

Folder tampilan:
resources/views/rooms/
resources/views/reservations/

---

## 🏠 *2.2.1 Melihat Daftar Kamar*

Route:


GET /
GET /rooms/{slug}


User dapat melihat:

* Foto kamar
* Harga
* Fasilitas
* Deskripsi

---

## 🧾 *2.2.2 Melakukan Reservasi*

Route:


POST /rooms/{room:slug}/reserve


Langkah:

1. Login terlebih dahulu.
2. Pilih kamar.
3. Klik *Reserve / Pesan*.
4. Pilih tanggal:

   * Check-in
   * Check-out
5. Klik *Submit Reservasi*.

Status awal reservasi → *Pending*.

---

## 📂 *2.2.3 Melihat Reservasi Saya*

Route:


GET /my-reservations


User dapat melihat:

* Daftar reservasi
* Status (Pending / Approved / Rejected)
* Opsi pembatalan

---

## 🔍 *2.2.4 Detail Reservasi*

Route:


GET /reservations/{reservation}


---

## ❌ *2.2.5 Membatalkan Reservasi*

Route:


POST /reservations/{reservation}/cancel


User hanya bisa membatalkan reservasi *jika status masih Pending*.

---

# 🛠 *2.3 Menggunakan Aplikasi sebagai Admin*

Prefix route:


/admin


Folder tampilan:
resources/views/admin/

---

## 🏨 *2.3.1 Mengelola Kamar*

Route Resource:


admin/rooms/*


Admin dapat:

* Menambah kamar
* Mengedit kamar
* Menghapus kamar
* Melihat preview kamar

---

## 📊 *2.3.2 Mengelola Reservasi User*

Route:


GET admin/reservations
POST admin/reservations/{id}/status


Admin dapat:

* Melihat semua reservasi
* Melihat detail pesanan
* Menyetujui (Approve)
* Menolak (Reject)

---

# 🔁 *2.4 Ringkasan Alur User*

1. Registrasi → Login
2. Pilih kamar
3. Lakukan reservasi
4. Menunggu persetujuan admin
5. Jika *Approved* → Reservasi aktif
6. Jika *Rejected* → Reservasi gagal

---

# 🔁 *2.5 Ringkasan Alur Admin*

1. Login sebagai admin
2. Kelola kamar (CRUD)
3. Cek seluruh reservasi
4. Approve / Reject
5. Pantau status reservasi
