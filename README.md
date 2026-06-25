# Lab7Web - Praktikum Pemrograman Web 2 (CodeIgniter 4)

Repositori ini berisi kumpulan tugas dan implementasi dari Praktikum Pemrograman Web 2 menggunakan framework PHP **CodeIgniter 4**. Proyek ini mencakup modul praktikum yang saling terhubung, dimulai dari konfigurasi dasar framework dan arsitektur MVC, hingga pembuatan sistem CRUD, manajemen View Layout, dan implementasi Modul Login dengan *Authentication Filter*.

---

## 🚀 Praktikum 1: Dasar CodeIgniter 4 & Arsitektur MVC
Praktikum pertama difokuskan pada pengenalan dasar *framework* CodeIgniter 4 dan pemahaman konsep Model-View-Controller (MVC). Konsep ini memisahkan kode program berdasarkan alur logika, pengolahan data, dan tampilan antarmuka.

**Langkah-langkah Utama:**
* **Persiapan Lingkungan:** Mengaktifkan ekstensi PHP yang dibutuhkan pada XAMPP (seperti `php-json`, `php-mysqlnd`, dan `php-intl`).
* **Instalasi & CLI:** Melakukan instalasi manual CodeIgniter 4 dan menggunakan antarmuka baris perintah (CLI) bawaan yaitu `php spark` untuk mempermudah pengembangan.
* **Mode Debugging:** Mengubah status variabel `CI_ENVIRONMENT` menjadi `development` pada file `.env` untuk memudahkan pelacakan *error*.
* **Routing & Controller:** Membuat pengaturan *routing* pada `app/Config/Routes.php` untuk mengarahkan URL ke Controller tertentu (seperti halaman Home, About, Contact, dan FAQ).
* **View & Layout Dasar:** Membuat file View untuk menampilkan halaman web dan menggabungkannya dengan aset CSS statis (`style.css`) yang diletakkan pada folder `public`.

> **Hasil Praktikum 1:**
> ![foto](https://github.com/Manueljds2311105/Lab2_7_Web/blob/6a2b4dd4b8d7933b42e353a7b23edb0700773b64/Web2%20Praktikum%201-4%20SS/Screenshot%202026-04-03%20152137.png)

---

## 📝 Praktikum 2: Framework Lanjutan (CRUD)
Praktikum kedua melanjutkan pengembangan dengan membangun fitur CRUD (*Create, Read, Update, Delete*) untuk entitas data Artikel.

**Langkah-langkah Utama:**
* **Persiapan Database:** Membuat database MySQL bernama `lab_ci4` beserta tabel `artikel`.
* **Konfigurasi Koneksi:** Menghubungkan aplikasi dengan database melalui file konfigurasi `.env`.
* **Pembuatan Model:** Menggunakan `ArtikelModel` untuk merepresentasikan tabel database dan menentukan variabel seperti `$primaryKey` dan `$allowedFields`.
* **Controller & View (Frontend):** Membuat *method* `index()` pada `Artikel` Controller untuk mengambil data dari database dan menampilkannya pada halaman utama *portal berita*, serta *method* `view()` untuk menampilkan detail artikel.
* **Menu Admin (Backend):** Membuat rute khusus admin untuk melakukan proses CRUD, yang meliputi penambahan data (Add), pengubahan data (Edit), dan penghapusan data (Delete).

> **Hasil Praktikum 2:**
> ![foto](https://github.com/Manueljds2311105/Lab2_7_Web/blob/4892197e5a4502419fc0157cd43ab2f66e0d37d8/Web2%20Praktikum%201-4%20SS/Screenshot%202026-04-03%20160058.png)
> ![foto](https://github.com/Manueljds2311105/Lab2_7_Web/blob/4892197e5a4502419fc0157cd43ab2f66e0d37d8/Web2%20Praktikum%201-4%20SS/Screenshot%202026-04-03%20155434.png)

---

## 🎨 Praktikum 3: View Layout dan View Cell
Praktikum ini merapikan struktur tampilan aplikasi menggunakan konsep **View Layout** dan **View Cell**. Pendekatan ini membuat manajemen tampilan menjadi lebih modular, rapi, dan efisien. Selain itu, bagian ini juga mencakup penyelesaian tugas akhir modul.

**Langkah-langkah Utama & Penyelesaian Tugas:**
* **View Layout Utama:** Membuat file `main.php` di dalam folder `layout` sebagai templat dasar halaman. File *view* lainnya dimodifikasi agar mewarisi tata letak ini menggunakan sintaks `extend` dan mengisi bagian konten dengan `section`.
* **Penyesuaian Database (Tugas):** Menambahkan kolom `created_at` (DATETIME) untuk mengurutkan artikel dari yang terbaru, serta menambahkan kolom `kategori` (VARCHAR) pada tabel `artikel` di database MySQL.
* **Implementasi View Cell Custom:** Membuat komponen widget dinamis `ArtikelTerkini`. *Catatan pengembangan:* Kode disesuaikan dengan standar CodeIgniter 4 terbaru dengan melepaskan *class* dari `extends Cell` untuk menghindari konflik (*Fatal Error*).
* **Filter Kategori Tertentu (Tugas):** Memodifikasi logika pada fungsi `render()` di View Cell `ArtikelTerkini` untuk mengambil datanya sendiri ke Model. Data difilter menggunakan query builder `where('kategori', 'Berita')` dan diurutkan menggunakan `orderBy('created_at', 'DESC')`.

**Jawaban Pertanyaan Modul:**
* **Manfaat View Layout:** Meningkatkan *reusability* (penggunaan ulang kode) dan efisiensi. Kita tidak perlu menulis struktur dasar HTML berulang kali. Jika ada perubahan desain dasar (seperti menu navigasi), cukup edit satu file layout utama saja dan perubahannya otomatis teraplikasikan ke seluruh halaman.
* **Perbedaan View Biasa & View Cell:** View biasa dikendalikan penuh oleh *Controller* utama yang harus mengambil dan menyuplai semua data. Sebaliknya, View Cell adalah komponen UI mandiri yang bisa mengambil datanya sendiri (memanggil *Model* secara langsung) tanpa membebani *Controller* utama. Sangat cocok untuk *widget* dinamis yang berulang di banyak halaman.

> **Hasil Praktikum 3:**
> ![foto](https://github.com/Manueljds2311105/Lab2_7_Web/blob/01884f9c657f42e0d15f88bd8b73f3566c7e301d/Web2%20Praktikum%201-4%20SS/Screenshot%202026-04-03%20170431.png)

---

## 🔒 Praktikum 4: Modul Login & Filter Autentikasi
Praktikum terakhir berfokus pada keamanan aplikasi dengan menambahkan sistem Login (Autentikasi). Sistem ini membatasi akses ke menu Admin, sehingga hanya pengguna yang terdaftar yang dapat mengelola artikel.

**Langkah-langkah Utama:**
* **Tabel & Model User:** Membuat tabel `user` (dengan struktur kolom username, useremail, dan userpassword) beserta `UserModel` untuk menangani data kredensial.
* **Database Seeder:** Men-generate data pengguna *dummy* (termasuk *hashing* password menggunakan `password_hash`) langsung ke database melalui CLI menggunakan fitur `Database Seeder`.
* **Modul Login & Session:** Mengembangkan antarmuka Login (`login.php`) dan mengelola logika validasi login pada Controller `User`. Jika data cocok, informasi pengguna akan disimpan di dalam `session`. Fungsi logout juga ditambahkan untuk menghancurkan *session* saat ini.
* **Auth Filter:** Membatasi rute URL menggunakan *Filters*. Sebuah filter bernama `Auth` dibuat untuk mengecek keberadaan sesi login. Filter ini kemudian disisipkan ke dalam *route group* `admin`, yang secara otomatis akan menendang pengguna ke halaman login jika mencoba mengakses halaman admin tanpa sesi yang sah.

> **Hasil Praktikum 4:**
> ![foto](https://github.com/Manueljds2311105/Lab2_7_Web/blob/01884f9c657f42e0d15f88bd8b73f3566c7e301d/Web2%20Praktikum%201-4%20SS/Screenshot%202026-04-03%20170315.png)

---

## 📌 Praktikum 5: Pagination dan Pencarian

Pada praktikum ke-5 ini, fokus utama adalah mengoptimalkan tampilan dan pencarian data artikel pada halaman Admin.

### 1. Membuat Pagination
Pagination berfungsi untuk memecah tampilan data yang panjang menjadi beberapa halaman agar lebih rapi dan mempercepat waktu *loading* halaman. 
- **Controller:** Memanfaatkan fungsi `paginate()` bawaan CI4 pada `ArtikelModel` dengan batas 10 *record* per halaman.
- **View:** Menambahkan kode `<?= $pager->links(); ?>` di bawah tabel `admin_index.php` untuk memunculkan tombol navigasi halaman.

**Screenshot Hasil Pagination:**
![foto](https://github.com/Manueljds2311105/Lab2_7_Web/blob/123d9b42ae5b89f530c21410db30e4cd9070dadd/Web2%20Praktikum%201-4%20SS/Screenshot%202026-04-09%20104630.png)

### 2. Membuat Pencarian (Search)
Fitur pencarian digunakan untuk memfilter data artikel berdasarkan judul[cite: 71].
- **Controller:** Menangkap keyword dari form pencarian menggunakan `$this->request->getVar('q')` dan memfilternya menggunakan Query Builder `like('judul', $q)`.
- [cite_start]**View:** Menambahkan form HTML pencarian dengan method `GET` dan memastikan link pagination tetap membawa parameter pencarian dengan `$pager->only(['q'])->links()`.

**Screenshot Hasil Pencarian:**
![foto](https://github.com/Manueljds2311105/Lab2_7_Web/blob/123d9b42ae5b89f530c21410db30e4cd9070dadd/Web2%20Praktikum%201-4%20SS/Screenshot%202026-04-09%20104713.png)

---

## ✨ Praktikum 6: Relasi Tabel dan Query Builder

Pada praktikum ke-6 ini, dilakukan perombakan struktur database untuk menerapkan relasi *One-to-Many* dan menggunakan Query Builder untuk melakukan operasi `JOIN`.

### 1. Persiapan Database & Relasi Tabel
- Membuat tabel baru bernama `kategori` untuk menyimpan daftar kategori.
- Menambahkan kolom `id_kategori` sebagai *Foreign Key* pada tabel `artikel` agar saling terhubung.

### 2. Memodifikasi Model & Menggunakan Query Builder (JOIN)
- Membuat `KategoriModel` untuk berinteraksi dengan tabel kategori.
- Memodifikasi `ArtikelModel` dengan menambahkan fungsi baru yang menggunakan `->join('kategori', 'kategori.id_kategori = artikel.id_kategori')` agar nama kategori bisa ditarik bersamaan dengan data artikel.

### 3. Memodifikasi Controller & View (Form & Dropdown)
- **Controller:** Mengambil data kategori menggunakan `KategoriModel->findAll()` lalu mengirimkannya ke view untuk keperluan form Tambah, Edit, dan Filter.
- **View:** Mengubah input kategori yang awalnya statis/tidak ada menjadi *Dropdown* dinamis (`<select>`) menggunakan perulangan *foreach* pada form Add dan form Edit.

### 4. Penyelesaian Tugas Praktikum
- **Detail Artikel:** Memodifikasi `Artikel.php` fungsi `view()` menggunakan metode *JOIN*, sehingga pada halaman `artikel/detail.php` kini dapat menampilkan Nama Kategori artikel yang sedang dibaca.
- **Improvisasi:** Melakukan perbaikan validasi form tambah/edit dan menangani isu *foreign key* saat update artikel lama yang nilai kategorinya masih kosong/NULL.

**Screenshot Dashboard Admin (Data dengan Kategori):**
![foto](https://github.com/Manueljds2311105/Lab2_7_Web/blob/123d9b42ae5b89f530c21410db30e4cd9070dadd/Web2%20Praktikum%201-4%20SS/Screenshot%202026-04-22%20201004.png)

**Screenshot Form Tambah/Edit (Dropdown Kategori):**
![foto](https://github.com/Manueljds2311105/Lab2_7_Web/blob/123d9b42ae5b89f530c21410db30e4cd9070dadd/Web2%20Praktikum%201-4%20SS/Screenshot%202026-04-22%20200658.png)

---

## 🖼️ Praktikum 7: Upload File Gambar
Praktikum ini menambahkan fitur unggah (*upload*) berkas ke dalam aplikasi, khususnya untuk melampirkan gambar *thumbnail* atau *cover* pada setiap artikel.

**Langkah-langkah Utama:**
* **Modifikasi Form:** Menambahkan atribut `enctype="multipart/form-data"` pada tag `<form>` di halaman tambah dan edit artikel, serta menambahkan input bertipe `file`.
* **Penanganan di Controller:** Memodifikasi method `add()` dan `edit()` pada `Artikel.php` untuk menangkap file menggunakan `$this->request->getFile('gambar')`.
* **Penyimpanan File:** Memindahkan file gambar yang diunggah ke dalam direktori publik (`public/gambar`) menggunakan fungsi `move()`, dan menyimpan nama file tersebut (`getName()`) ke dalam database.

**Screenshot Hasil Praktikum 7:**
![foto](https://github.com/Manueljds2311105/Lab2_7_Web/blob/17b82943e122176a0d3c621172e47121b1f7f1a0/Web2%20Praktikum%20Screenshot/Screenshot%202026-06-13%20222350.png)

---

## ⚡ Praktikum 8: AJAX (Asynchronous JavaScript and XML)
Praktikum ini bertujuan untuk meningkatkan responsivitas antarmuka aplikasi. Dengan AJAX, halaman web dapat memperbarui dan menampilkan data dari server di latar belakang tanpa harus melakukan *reload* keseluruhan halaman.

**Langkah-langkah Utama:**
* **Persiapan Library:** Mengunduh dan melampirkan pustaka `jQuery` ke dalam file proyek.
* **Membuat AjaxController:** Membuat controller khusus yang mengembalikan data dari Model dalam format JSON menggunakan `$this->response->setJSON($data)`.
* **Implementasi di View:** Mengosongkan tabel HTML bawaan dan menggantinya dengan *script* `$.ajax` yang menembak URL `getData`. Data JSON yang diterima kemudian disusun ulang menjadi baris tabel (`<tr>`) secara dinamis menggunakan JavaScript.
* **Fitur Hapus Data:** Menambahkan konfirmasi hapus dan metode `DELETE` via AJAX, lalu me- *reload* tabel secara instan menggunakan fungsi `loadData()`.

**Screenshot Hasil Praktikum 8:**
![foto](https://github.com/Manueljds2311105/Lab2_7_Web/blob/cdd609817c8fb5716b168eff207595a4fe81c1f4/Web2%20Praktikum%20Screenshot/Screenshot%202026-06-13%20222842.png)

---

## 🔍 Praktikum 9: Implementasi AJAX Pagination dan Search
Melanjutkan konsep AJAX sebelumnya, praktikum ini memindahkan fitur pencarian (*search*) dan *pagination* yang awalnya berbasis pemuatan halaman (PHP standar) menjadi sepenuhnya *asynchronous* (AJAX).

**Langkah-langkah Utama:**
* **Modifikasi Controller:** Mengubah `admin_index` agar memiliki percabangan logika. Jika request adalah AJAX (`$this->request->isAJAX()`), maka kembalikan data dan *pager* dalam format JSON. Jika tidak, tampilkan View biasa.
* **Penanganan Form Filter:** Menambahkan *event listener* `submit` pada form pencarian dan `change` pada *dropdown* kategori di JavaScript untuk memicu pengambilan data ulang (`fetchData`).
* **Indikator Loading:** Menambahkan parameter `beforeSend` pada Axios/jQuery untuk menampilkan teks "Sedang memuat data artikel..." agar User Experience (UX) lebih baik saat menunggu respon server.

**Screenshot Hasil Praktikum 9:**
![foto](https://github.com/Manueljds2311105/Lab2_7_Web/blob/21abae28e2392c6605e626e372188e6e672a83c3/Web2%20Praktikum%20Screenshot/Screenshot%202026-06-13%20220011.png)

---

## 🌐 Praktikum 10: Pembuatan RESTful API CodeIgniter 4
Praktikum ini merombak peran CodeIgniter 4 yang awalnya berperan penuh (Fullstack) menjadi hanya sebagai penyedia layanan *Backend* berbasis RESTful API (REST Server).

**Langkah-langkah Utama:**
* **REST Controller:** Membuat `Post.php` di dalam direktori Controllers yang mewarisi `ResourceController` dan menggunakan `ResponseTrait`.
* **Endpoint CRUD:** Mengimplementasikan 5 metode standar REST: `index()` (GET All), `show()` (GET Spesifik), `create()` (POST), `update()` (PUT/PATCH), dan `delete()` (DELETE).
* **Konfigurasi Route:** Menambahkan `$routes->resource('post')` pada `Routes.php` untuk memetakan URL secara otomatis.
* **Testing API:** Melakukan pengujian seluruh *endpoint* pengolahan data menggunakan aplikasi klien Postman dan memastikan format respon berupa JSON.

**Screenshot Hasil Pengujian Postman:**
![foto](https://github.com/Manueljds2311105/Lab2_7_Web/blob/a755ed040f1beba6531ae66d1da00a8d8b31f437/Web2%20Praktikum%20Screenshot/Screenshot%202026-06-13%20223817.png)

---

## 🟢 Praktikum 11: Pengenalan VueJS (Frontend)
Pada modul ini, *Frontend* dibangun secara terpisah menggunakan framework JavaScript modern, **VueJS** (melalui CDN), dan menggunakan **Axios** untuk berkomunikasi dengan REST API CodeIgniter 4.

**Langkah-langkah Utama:**
* **Inisialisasi Vue:** Menggunakan `Vue.createApp` untuk menginisialisasi state data (`artikel`, `formData`, `showForm`).
* **Menampilkan Data (Read):** Menggunakan siklus `mounted()` untuk memanggil `axios.get` dan merender tabel HTML dinamis menggunakan direktif `v-for`.
* **Form Modal (Create & Update):** Membuat modal *pop-up* tersembunyi yang dimunculkan menggunakan `v-if`. Data formulir diikat (*binding*) menggunakan `v-model`. Aksi simpan dibedakan berdasarkan keberadaan `id` (menjadi `axios.post` atau `axios.put`).

**Screenshot Hasil Praktikum 11:**
![foto](https://github.com/Manueljds2311105/Lab2_7_Web/blob/7777b8a45376828b2375f1f244dae6f6adb025d9/Web2%20Praktikum%20Screenshot/Screenshot%202026-06-13%20224020.png)

---

## 🚀 Praktikum 12: VueJS Komponen dan Routing (Single Page Application)
Aplikasi VueJS ditingkatkan menjadi Single Page Application (SPA). Antarmuka web dipecah menjadi beberapa *Component* dan perpindahan halaman ditangani oleh **Vue Router** tanpa *reload* browser.

**Langkah-langkah Utama:**
* **Pemisahan Komponen:** Memecah kode logika dan *template* HTML menjadi file komponen mandiri: `Home.js`, `Artikel.js`, dan `About.js` (Tugas Tambahan).
* **Konfigurasi Router:** Mendaftarkan komponen-komponen tersebut ke dalam rute (`/`, `/artikel`, `/about`) menggunakan `createWebHashHistory()` di `app.js`.
* **Master Layout:** Mengubah `index.html` menggunakan elemen `<router-link>` untuk navigasi menu dan `<router-view>` sebagai area wadah dinamis tempat komponen dirender.

**Screenshot Halaman SPA (About/Profil):**
![foto](https://github.com/Manueljds2311105/Lab2_7_Web/blob/9992137178a837b32a51681c748f05c75294ed01/Web2%20Praktikum%20Screenshot/Screenshot%202026-06-13%20224358.png)

---

## 🔐 Praktikum 13: VueJS Autentikasi dan Navigation Guards
Praktikum ini menerapkan *Client-Side Security*. Rute halaman admin dilindungi sehingga pengguna harus melakukan *login* terlebih dahulu.

**Langkah-langkah Utama:**
* **API Auth (Backend):** Membuat Controller `Api\Auth.php` di CI4 untuk memvalidasi *username* dan *password* dari database, lalu mengembalikan token rahasia berformat JSON.
* **Form Login Vue:** Membuat komponen `Login.js` dan mengirimkan data login via *Axios POST*. Jika berhasil, status `isLoggedIn` dan token disimpan ke dalam `localStorage` browser.
* **Navigation Guards:** Memasang meta tag `requiresAuth` pada rute `/artikel` dan `/about`. Menggunakan fungsi pencegat `router.beforeEach` untuk memblokir akses dan mengalihkan paksa ke rute `/login` jika *localStorage* tidak memiliki sesi yang sah.

**Screenshot Hasil Praktikum 13:**
![foto](https://github.com/Manueljds2311105/Lab2_7_Web/blob/73c404cff2c17222c813bc65b445edff389af095/Web2%20Praktikum%20Screenshot/Screenshot%202026-06-13%20224626.png)

---

## 🛡️ Praktikum 14: Keamanan API, Autentikasi Token, dan Axios Interceptors
Ini adalah tahap akhir penerapan keamanan *Server-Side*. Modul ini memastikan REST API CodeIgniter 4 tidak bisa dimanipulasi secara ilegal menggunakan *tools* eksternal (seperti Postman) tanpa menyertakan Token yang valid.

**Langkah-langkah Utama:**
* **CI4 Filter (Backend):** Membuat `ApiAuthFilter.php` untuk mengekstrak dan memvalidasi `Authorization: Bearer <token>` dari *HTTP Header*. Filter ini diterapkan khusus untuk rute `POST`, `PUT`, dan `DELETE` artikel.
* **Axios Interceptors (Frontend):** Menambahkan logika `axios.interceptors.request.use` pada `app.js` VueJS. Fitur ini secara otomatis mengambil token dari `localStorage` dan menyuntikkannya ke dalam *Request Headers* setiap kali aplikasi frontend meminta atau mengirim data ke backend.
* **Penanganan Error Global:** Menggunakan *interceptors response* untuk menangkap error HTTP 401 (Unauthorized) dari server, membersihkan *localStorage*, dan mengeluarkan (logout) pengguna secara paksa.

**Screenshot Hasil Praktikum 14:**
![foto](https://github.com/Manueljds2311105/Lab2_7_Web/blob/73c404cff2c17222c813bc65b445edff389af095/Web2%20Praktikum%20Screenshot/Screenshot%202026-06-13%20212955.png)
![foto](https://github.com/Manueljds2311105/Lab2_7_Web/blob/937346e4d4edc024d1c9bec8b5dabc17ee24125e/Web2%20Praktikum%20Screenshot/Screenshot%202026-06-13%20214217.png)
![foto](https://github.com/Manueljds2311105/Lab2_7_Web/blob/937346e4d4edc024d1c9bec8b5dabc17ee24125e/Web2%20Praktikum%20Screenshot/Screenshot%202026-06-13%20214244.png)

**Dikerjakan Oleh:**
Manuel_312410493 (Manueljds2311105)

*Proyek ini dikembangkan sebagai bagian dari Modul Praktikum Pemrograman Web 2 Universitas Pelita Bangsa.*
