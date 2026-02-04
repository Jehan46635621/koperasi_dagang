# User Guide

# Koperasi Dagang - Panduan Pengguna

---

## Informasi Dokumen

|                    |                                  |
| ------------------ | -------------------------------- |
| **Judul Dokumen**  | Panduan Pengguna Koperasi Dagang |
| **Versi**          | 1.0                              |
| **Tanggal**        | 3 Februari 2026                  |
| **Bahasa**         | Bahasa Indonesia                 |
| **Target Pembaca** | Semua pengguna sistem            |

---

## Daftar Isi

1. [Pendahuluan](#1-pendahuluan)
2. [Memulai Penggunaan](#2-memulai-penggunaan)
3. [Dashboard](#3-dashboard)
4. [Manajemen Anggota](#4-manajemen-anggota)
5. [Simpanan](#5-simpanan)
6. [Pinjaman](#6-pinjaman)
7. [Perdagangan/POS](#7-perdaganganpos)
8. [Akuntansi](#8-akuntansi)
9. [Laporan](#9-laporan)
10. [Pengaturan](#10-pengaturan)
11. [FAQ](#11-faq)
12. [Troubleshooting](#12-troubleshooting)

---

## 1. Pendahuluan

### 1.1 Tentang Koperasi Dagang

Koperasi Dagang adalah sistem manajemen koperasi berbasis web yang terintegrasi untuk mengelola:

- **Keanggotaan**: Pendaftaran dan pengelolaan data anggota
- **Simpanan**: Simpanan pokok, wajib, dan sukarela
- **Pinjaman**: Pengajuan, persetujuan, dan pelunasan pinjaman
- **Perdagangan**: Point of Sale dan manajemen inventori
- **Akuntansi**: Pencatatan keuangan dan laporan

### 1.2 Persyaratan Sistem

| Komponen         | Persyaratan Minimum                           |
| ---------------- | --------------------------------------------- |
| Browser          | Chrome 90+, Firefox 88+, Safari 14+, Edge 90+ |
| Resolusi Layar   | 1280 x 720 pixel                              |
| Koneksi Internet | Stabil, minimal 1 Mbps                        |
| JavaScript       | Harus diaktifkan                              |

### 1.3 Peran Pengguna

| Peran                  | Tugas Utama                            |
| ---------------------- | -------------------------------------- |
| **Super Admin**        | Konfigurasi sistem, manajemen pengguna |
| **Manager (Pengurus)** | Persetujuan, laporan, pengawasan       |
| **Teller (Kasir)**     | Transaksi simpanan, pembayaran, POS    |
| **Loan Officer**       | Pinjaman, analisis kredit, penagihan   |
| **Akuntan**            | Jurnal, laporan keuangan               |
| **Staf Gudang**        | Inventori, penerimaan barang           |
| **Member Services**    | Pendaftaran anggota, layanan           |
| **Auditor**            | Pemeriksaan, audit trail               |

---

## 2. Memulai Penggunaan

### 2.1 Login ke Sistem

1. Buka browser dan akses URL sistem: `https://[alamat-koperasi].com`
2. Masukkan **Email** yang terdaftar
3. Masukkan **Password**
4. Klik tombol **Masuk**

![Login Screen](./images/login.png)

> ⚠️ **Perhatian**: Setelah 5 kali gagal login, akun akan terkunci selama 30 menit.

### 2.2 Lupa Password

1. Di halaman login, klik **Lupa Password?**
2. Masukkan alamat email terdaftar
3. Klik **Kirim Link Reset**
4. Cek email Anda dan klik link reset
5. Masukkan password baru (minimal 8 karakter, kombinasi huruf dan angka)
6. Konfirmasi password baru
7. Klik **Simpan Password**

### 2.3 Mengganti Password

1. Klik ikon profil di pojok kanan atas
2. Pilih **Profil Saya**
3. Klik tab **Keamanan**
4. Masukkan password lama
5. Masukkan password baru
6. Konfirmasi password baru
7. Klik **Simpan**

### 2.4 Navigasi Dasar

```
┌────────────────────────────────────────────────────────────────┐
│  [Logo]  Koperasi Dagang                    [Notif] [Profil]  │
├────────────┬───────────────────────────────────────────────────┤
│            │                                                   │
│ Dashboard  │                                                   │
│ Anggota    │              AREA KONTEN UTAMA                    │
│ Simpanan   │                                                   │
│ Pinjaman   │                                                   │
│ Perdagangan│                                                   │
│ Akuntansi  │                                                   │
│ Laporan    │                                                   │
│ Pengaturan │                                                   │
│            │                                                   │
└────────────┴───────────────────────────────────────────────────┘
```

- **Sidebar Kiri**: Menu navigasi utama
- **Header**: Logo, notifikasi, profil pengguna
- **Area Konten**: Halaman yang sedang aktif
- **Breadcrumb**: Menunjukkan lokasi halaman saat ini

---

## 3. Dashboard

### 3.1 Tampilan Dashboard

Dashboard menampilkan ringkasan informasi penting sesuai dengan peran pengguna.

#### Widget yang Tersedia

| Widget                  | Deskripsi                            | Peran                 |
| ----------------------- | ------------------------------------ | --------------------- |
| **Total Anggota**       | Jumlah anggota aktif dan pertumbuhan | Semua                 |
| **Saldo Simpanan**      | Total simpanan per jenis             | Manager, Akuntan      |
| **Portofolio Pinjaman** | Outstanding dan NPL ratio            | Manager, Loan Officer |
| **Penjualan Hari Ini**  | Total penjualan dan transaksi        | Manager, Teller       |
| **Posisi Kas**          | Saldo kas saat ini                   | Manager, Teller       |
| **Persetujuan Pending** | Daftar yang menunggu persetujuan     | Manager               |
| **Transaksi Terakhir**  | 10 transaksi terbaru                 | Semua                 |
| **Stok Menipis**        | Produk di bawah minimum              | Manager, Gudang       |

### 3.2 Menggunakan Dashboard

1. **Refresh Data**: Klik ikon 🔄 pada widget untuk memperbarui
2. **Lihat Detail**: Klik widget untuk melihat detail lengkap
3. **Filter Tanggal**: Beberapa widget memiliki filter periode
4. **Aksi Cepat**: Klik tombol aksi untuk proses langsung

---

## 4. Manajemen Anggota

### 4.1 Mencari Anggota

1. Buka menu **Anggota** → **Cari Anggota**
2. Masukkan kriteria pencarian:
   - Nomor Anggota
   - Nama
   - NIK
   - Nomor Telepon
3. Pilih filter status (jika perlu)
4. Klik **Cari** atau tekan Enter
5. Klik baris anggota untuk melihat detail

> 💡 **Tips**: Gunakan pencarian sebagian nama untuk hasil lebih luas

### 4.2 Mendaftarkan Anggota Baru

**Langkah-langkah:**

1. Buka menu **Anggota** → **Pendaftaran**
2. Isi data wajib:

| Field         | Keterangan                |
| ------------- | ------------------------- |
| NIK           | 16 digit NIK sesuai KTP   |
| Nama Lengkap  | Sesuai identitas resmi    |
| Jenis Kelamin | Pilih L/P                 |
| Alamat        | Alamat lengkap            |
| Telepon       | Nomor yang bisa dihubungi |
| Jenis Anggota | Pilih kategori anggota    |

3. Isi data opsional (jika tersedia):
   - Tempat/Tanggal Lahir
   - Pekerjaan
   - Penghasilan Bulanan
   - Email
   - Data Keluarga/Ahli Waris

4. Upload dokumen:
   - Foto KTP (wajib)
   - Foto diri (wajib)
   - Kartu Keluarga (opsional)

5. Klik **Simpan sebagai Draft** atau **Kirim untuk Persetujuan**

### 4.3 Menyetujui Pendaftaran Anggota

**Peran yang diperlukan**: Manager

1. Buka menu **Anggota** → **Persetujuan Pending**
2. Klik aplikasi yang akan diproses
3. Periksa kelengkapan data dan dokumen
4. Verifikasi pembayaran Simpanan Pokok
5. Pilih tindakan:
   - **Setuju**: Anggota menjadi aktif
   - **Tolak**: Sertakan alasan penolakan
6. Klik **Konfirmasi**

### 4.4 Mengupdate Data Anggota

1. Cari dan buka profil anggota
2. Klik tombol **Edit**
3. Ubah data yang diperlukan
4. Klik **Simpan**

> ⚠️ **Perhatian**: NIK tidak dapat diubah setelah anggota disetujui

### 4.5 Proses Pengunduran Diri

1. Cari dan buka profil anggota
2. Klik **Aksi** → **Proses Pengunduran Diri**
3. Sistem akan memeriksa:
   - Saldo pinjaman outstanding
   - Saldo simpanan yang harus diselesaikan
4. Jika tidak ada pinjaman aktif:
   - Masukkan alasan pengunduran diri
   - Pilih metode penyelesaian simpanan
   - Klik **Ajukan Pengunduran Diri**
5. Manager menyetujui dan memproses penyelesaian

---

## 5. Simpanan

### 5.1 Jenis Simpanan

| Jenis                 | Keterangan                                                                             |
| --------------------- | -------------------------------------------------------------------------------------- |
| **Simpanan Pokok**    | Setoran awal satu kali saat mendaftar. Tidak dapat ditarik sampai keluar dari koperasi |
| **Simpanan Wajib**    | Setoran rutin bulanan yang wajib dibayarkan                                            |
| **Simpanan Sukarela** | Tabungan fleksibel yang dapat disetor/ditarik kapan saja                               |

### 5.2 Melakukan Setoran (Deposit)

**Peran yang diperlukan**: Teller

1. Buka menu **Simpanan** → **Setoran**
2. **Cari Anggota**:
   - Ketik nomor anggota atau nama
   - Pilih anggota dari hasil pencarian
3. **Pilih Rekening Simpanan**:
   - Sistem menampilkan semua rekening aktif
   - Pilih jenis simpanan yang akan diisi
4. **Masukkan Jumlah**:
   - Ketik nominal setoran
   - Pastikan memenuhi minimum setoran
5. **Deskripsi** (opsional):
   - Tambahkan keterangan jika perlu
6. Klik **Proses Setoran**
7. **Konfirmasi**:
   - Periksa kembali detail transaksi
   - Klik **Konfirmasi**
8. **Cetak Bukti**:
   - Klik **Cetak Bukti Setoran** untuk mencetak struk

**Contoh Tampilan:**

```
┌─────────────────────────────────────────────┐
│         BUKTI SETORAN SIMPANAN              │
├─────────────────────────────────────────────┤
│ No. Transaksi  : SAV-20260203-00001         │
│ Tanggal        : 03/02/2026 10:30           │
│ Kasir          : Budi Santoso               │
├─────────────────────────────────────────────┤
│ No. Anggota    : MBR-2024-00123             │
│ Nama           : Ahmad Wijaya               │
│ Jenis Simpanan : Simpanan Sukarela          │
│ Jumlah Setoran : Rp 500.000                 │
│ Saldo Sebelum  : Rp 2.000.000               │
│ Saldo Setelah  : Rp 2.500.000               │
├─────────────────────────────────────────────┤
│ Terima kasih telah menabung di koperasi     │
└─────────────────────────────────────────────┘
```

### 5.3 Melakukan Penarikan (Withdrawal)

**Peran yang diperlukan**: Teller

1. Buka menu **Simpanan** → **Penarikan**
2. **Cari Anggota** dan pilih rekening
3. Sistem menampilkan:
   - Saldo saat ini
   - Saldo minimum yang harus dijaga
   - Saldo tersedia untuk penarikan
   - Limit penarikan harian (jika ada)
4. **Masukkan Jumlah Penarikan**:
   - Tidak boleh melebihi saldo tersedia
   - Tidak boleh melebihi limit harian
5. Klik **Proses Penarikan**
6. **Konfirmasi** dan serahkan uang ke anggota
7. **Cetak Bukti Penarikan**

> ⚠️ **Perhatian**:
>
> - Simpanan Pokok tidak dapat ditarik
> - Penarikan di atas limit tertentu memerlukan persetujuan Manager

### 5.4 Cek Saldo Anggota

1. Buka menu **Simpanan** → **Cek Saldo**
2. Cari dan pilih anggota
3. Sistem menampilkan semua rekening dengan:
   - Jenis simpanan
   - Nomor rekening
   - Saldo saat ini
   - Tanggal transaksi terakhir
   - Bunga yang diperoleh (YTD)

### 5.5 Cetak Buku Tabungan

1. Cari dan pilih anggota
2. Pilih rekening simpanan
3. Klik **Cetak Buku Tabungan**
4. Pilih periode:
   - Sejak pencetakan terakhir
   - Periode tertentu
   - Semua transaksi
5. Klik **Cetak** atau **Download PDF**

---

## 6. Pinjaman

### 6.1 Jenis Pinjaman

| Jenis                  | Keterangan                                           |
| ---------------------- | ---------------------------------------------------- |
| **Pinjaman Produktif** | Untuk modal usaha atau pengembangan bisnis           |
| **Pinjaman Konsumtif** | Untuk kebutuhan pribadi (pendidikan, kesehatan, dll) |
| **Pinjaman Darurat**   | Untuk kebutuhan mendesak dengan proses cepat         |

### 6.2 Mengajukan Pinjaman

**Peran yang diperlukan**: Loan Officer

1. Buka menu **Pinjaman** → **Pengajuan Baru**
2. **Cari Anggota**:
   - Sistem menampilkan status kelayakan
   - Riwayat pinjaman sebelumnya
3. **Pilih Produk Pinjaman**:
   - Sistem menampilkan suku bunga dan ketentuan
4. **Isi Detail Pinjaman**:

| Field           | Keterangan                 |
| --------------- | -------------------------- |
| Jumlah Pinjaman | Dalam batas min-max produk |
| Jangka Waktu    | Dalam bulan                |
| Tujuan Pinjaman | Jelaskan penggunaan dana   |

5. **Isi Data Jaminan** (jika diperlukan):
   - Jenis jaminan
   - Deskripsi
   - Estimasi nilai
   - Upload dokumen jaminan

6. Sistem menghitung otomatis:
   - Angsuran per bulan
   - Total bunga
   - Biaya admin
   - Total yang harus dibayar
   - Jumlah yang dicairkan

7. Klik **Simpan Draft** atau **Kirim untuk Analisis**

### 6.3 Analisis Kredit

**Peran yang diperlukan**: Loan Officer

1. Buka menu **Pinjaman** → **Analisis Pending**
2. Pilih pengajuan yang akan dianalisis
3. Isi formulir analisis 5C:

| Komponen       | Yang Dinilai                                       |
| -------------- | -------------------------------------------------- |
| **Character**  | Riwayat pembayaran, reputasi anggota               |
| **Capacity**   | Kemampuan bayar, rasio hutang terhadap penghasilan |
| **Capital**    | Saldo simpanan, kekayaan bersih                    |
| **Collateral** | Nilai jaminan (jika ada)                           |
| **Condition**  | Tujuan pinjaman, kondisi ekonomi                   |

4. Sistem menghitung **Rasio DTI** (Debt-to-Income):

   ```
   DTI = (Total Angsuran / Penghasilan Bulanan) × 100%

   Kriteria:
   - Rendah  : DTI ≤ 30%
   - Sedang  : DTI 31-50%
   - Tinggi  : DTI > 50%
   ```

5. Berikan **Rekomendasi**: Disetujui / Ditolak / Perlu Revisi
6. Klik **Kirim untuk Persetujuan**

### 6.4 Menyetujui Pinjaman

**Peran yang diperlukan**: Manager

1. Buka menu **Pinjaman** → **Persetujuan Pending**
2. Pilih pengajuan yang akan direview
3. Periksa:
   - Data anggota dan kelayakan
   - Hasil analisis kredit
   - Dokumen pendukung
   - Jaminan (jika ada)
4. Pilih keputusan:
   - **Setujui**: Pinjaman siap dicairkan
   - **Tolak**: Sertakan alasan penolakan
   - **Revisi**: Kembalikan ke Loan Officer dengan catatan
5. Klik **Konfirmasi**

### 6.5 Pencairan Pinjaman

**Peran yang diperlukan**: Teller atau Loan Officer

1. Buka menu **Pinjaman** → **Pencairan**
2. Pilih pinjaman yang sudah disetujui
3. Verifikasi penandatanganan perjanjian pinjaman
4. Pilih metode pencairan:
   - **Ke Rekening Simpanan**: Pilih rekening tujuan
   - **Tunai**: Siapkan uang tunai
5. Konfirmasi detail:
   ```
   Jumlah Pokok      : Rp 10.000.000
   Biaya Admin       : Rp    100.000 (1%)
   Asuransi          : Rp     50.000 (0.5%)
   ─────────────────────────────────
   Jumlah Cair       : Rp  9.850.000
   ```
6. Klik **Proses Pencairan**
7. Sistem otomatis:
   - Membuat jadwal angsuran
   - Memposting ke jurnal
   - Mengupdate status pinjaman ke "Aktif"
8. Cetak:
   - Perjanjian Pinjaman
   - Jadwal Angsuran
   - Bukti Pencairan

### 6.6 Menerima Pembayaran Angsuran

**Peran yang diperlukan**: Teller

1. Buka menu **Pinjaman** → **Pembayaran**
2. **Cari Pinjaman**:
   - Berdasarkan nomor pinjaman, atau
   - Berdasarkan nama/nomor anggota
3. Sistem menampilkan informasi pinjaman:
   - Angsuran jatuh tempo
   - Tunggakan (jika ada)
   - Denda (jika ada)
   - Outstanding saldo
4. **Masukkan Jumlah Pembayaran**
5. Sistem mengalokasikan otomatis:
   ```
   Prioritas alokasi:
   1. Denda (jika ada)
   2. Bunga
   3. Pokok
   ```
6. Pilih metode pembayaran:
   - Tunai
   - Potong dari Simpanan
7. Klik **Proses Pembayaran**
8. Cetak bukti pembayaran

### 6.7 Pelunasan Dipercepat

1. Cari pinjaman aktif anggota
2. Klik **Pelunasan Dipercepat**
3. Sistem menghitung:
   - Sisa pokok
   - Bunga berjalan
   - Total pelunasan
4. Proses pembayaran
5. Status pinjaman berubah menjadi "Lunas"

### 6.8 Melihat Laporan Aging Pinjaman

**Peran yang diperlukan**: Loan Officer, Manager

1. Buka menu **Pinjaman** → **Laporan Aging**
2. Pilih tanggal pelaporan
3. Sistem menampilkan klasifikasi:

| Kategori               | Hari Tunggakan | Kolektibilitas |
| ---------------------- | -------------- | -------------- |
| Lancar                 | 0 hari         | 1              |
| Dalam Perhatian Khusus | 1-30 hari      | 2              |
| Kurang Lancar          | 31-60 hari     | 3              |
| Diragukan              | 61-90 hari     | 4              |
| Macet                  | > 90 hari      | 5              |

4. Klik kategori untuk melihat detail pinjaman
5. Export ke Excel untuk analisis lebih lanjut

---

## 7. Perdagangan/POS

### 7.1 Melakukan Transaksi Penjualan

**Peran yang diperlukan**: Teller (Kasir)

1. Buka menu **Perdagangan** → **Point of Sale**
2. **Tambah Produk**:
   - Scan barcode, atau
   - Ketik nama/SKU produk
   - Pilih dari daftar
3. **Atur Kuantitas**:
   - Klik +/- atau ketik langsung
4. **Identifikasi Pembeli** (opsional):
   - Jika anggota: masukkan nomor anggota
   - Harga anggota otomatis diterapkan
5. **Total Pembelian** ditampilkan
6. **Terima Pembayaran**:
   - Masukkan jumlah uang diterima
   - Sistem menghitung kembalian
7. Klik **Selesai**
8. Cetak struk

**Tampilan POS:**

```
┌─────────────────────────────────────────────────────────┐
│  [Pencarian Produk...]              [Scan Barcode]     │
├────────────────────────────┬────────────────────────────┤
│ KERANJANG BELANJA          │ PRODUK                     │
├────────────────────────────┤                            │
│ Beras 5kg         x2       │ [Beras 5kg    Rp 75.000]  │
│              Rp 150.000    │ [Minyak 2L    Rp 35.000]  │
│                            │ [Gula 1kg     Rp 15.000]  │
│ Minyak Goreng 2L  x1       │ [Kopi Sachet  Rp  2.000]  │
│               Rp 35.000    │ [Teh Celup    Rp  5.000]  │
│                            │                            │
├────────────────────────────┤                            │
│ Subtotal:    Rp 185.000    │                            │
│ Diskon:      Rp       0    │                            │
│ TOTAL:       Rp 185.000    │                            │
├────────────────────────────┤                            │
│ [Anggota: MBR-2024-00123]  │                            │
│ Bayar:       [Rp 200.000]  │                            │
│ Kembali:     Rp  15.000    │                            │
│        [BAYAR & SELESAI]   │                            │
└────────────────────────────┴────────────────────────────┘
```

### 7.2 Mengelola Produk

**Peran yang diperlukan**: Admin, Manager

#### Menambah Produk Baru

1. Buka menu **Perdagangan** → **Produk**
2. Klik **Tambah Produk**
3. Isi informasi produk:

| Field         | Keterangan              |
| ------------- | ----------------------- |
| SKU           | Kode unik produk        |
| Barcode       | Kode barcode (opsional) |
| Nama          | Nama produk             |
| Kategori      | Pilih kategori          |
| Satuan        | pcs, kg, liter, dll     |
| Harga Beli    | Harga dari supplier     |
| Harga Jual    | Harga untuk umum        |
| Harga Anggota | Harga khusus anggota    |
| Stok Minimum  | Batas reorder           |

4. Upload foto produk (opsional)
5. Klik **Simpan**

#### Mengubah Harga

1. Cari produk yang akan diubah
2. Klik **Edit**
3. Ubah harga jual/harga anggota
4. Klik **Simpan**

### 7.3 Penerimaan Barang

**Peran yang diperlukan**: Staff Gudang

1. Buka menu **Perdagangan** → **Penerimaan Barang**
2. Jika ada PO: Pilih PO dari daftar
3. Jika tanpa PO: Klik **Penerimaan Langsung**
4. Pilih supplier
5. Tambahkan item:
   - Pilih produk
   - Masukkan kuantitas diterima
   - Masukkan harga beli
6. Masukkan nomor faktur supplier
7. Klik **Simpan Draft** atau **Posting**
8. Setelah posting:
   - Stok bertambah otomatis
   - Jurnal tercatat

### 7.4 Melihat Stok

1. Buka menu **Perdagangan** → **Inventori**
2. Tampilan daftar produk dengan:
   - Stok saat ini
   - Stok minimum
   - Status (Normal / Menipis / Habis)
3. Filter berdasarkan:
   - Kategori
   - Status stok
   - Supplier
4. Klik produk untuk melihat:
   - Kartu stok (riwayat pergerakan)
   - Grafik pergerakan

---

## 8. Akuntansi

### 8.1 Membuat Jurnal Manual

**Peran yang diperlukan**: Akuntan

1. Buka menu **Akuntansi** → **Jurnal**
2. Klik **Jurnal Baru**
3. Isi header jurnal:
   - Tanggal (harus dalam periode terbuka)
   - Deskripsi/Keterangan
4. Tambah baris jurnal:

| Akun         | Debet     | Kredit    | Keterangan         |
| ------------ | --------- | --------- | ------------------ |
| [Pilih akun] | [Nominal] |           | [Keterangan baris] |
| [Pilih akun] |           | [Nominal] | [Keterangan baris] |

5. Pastikan **Total Debet = Total Kredit**
6. Klik **Simpan Draft** atau **Posting**

> ⚠️ **Perhatian**: Jurnal yang sudah diposting tidak dapat diubah. Gunakan jurnal koreksi jika ada kesalahan.

### 8.2 Melihat Buku Besar

1. Buka menu **Akuntansi** → **Buku Besar**
2. Pilih akun yang ingin dilihat
3. Pilih periode
4. Sistem menampilkan:
   - Saldo awal
   - Daftar transaksi
   - Saldo akhir

### 8.3 Neraca Saldo

1. Buka menu **Akuntansi** → **Neraca Saldo**
2. Pilih periode/tanggal
3. Sistem menampilkan:
   - Semua akun dengan saldo
   - Kolom Debet dan Kredit
   - Total (harus balance)
4. Export ke Excel atau PDF

### 8.4 Laporan Keuangan

1. Buka menu **Laporan** → **Laporan Keuangan**
2. Pilih jenis laporan:
   - **Neraca**: Posisi keuangan
   - **Laba Rugi**: Hasil usaha
   - **Arus Kas**: Pergerakan kas
3. Pilih periode
4. Klik **Generate**
5. Preview dan print/export

---

## 9. Laporan

### 9.1 Laporan Anggota

| Laporan               | Deskripsi                          |
| --------------------- | ---------------------------------- |
| Daftar Anggota        | Semua anggota dengan filter status |
| Anggota Baru          | Anggota terdaftar dalam periode    |
| Statistik Keanggotaan | Grafik pertumbuhan anggota         |
| Pengunduran Diri      | Anggota yang mengundurkan diri     |

### 9.2 Laporan Simpanan

| Laporan              | Deskripsi                |
| -------------------- | ------------------------ |
| Ringkasan Simpanan   | Total per jenis simpanan |
| Mutasi Simpanan      | Transaksi per periode    |
| Simpanan per Anggota | Detail simpanan anggota  |
| Perhitungan Bunga    | Bunga yang dibayarkan    |

### 9.3 Laporan Pinjaman

| Laporan             | Deskripsi                      |
| ------------------- | ------------------------------ |
| Portofolio Pinjaman | Semua pinjaman aktif           |
| Analisis Aging      | Klasifikasi kolektibilitas     |
| Pencairan           | Pinjaman dicairkan per periode |
| Angsuran Diterima   | Pembayaran per periode         |
| NPL                 | Pinjaman bermasalah            |

### 9.4 Laporan Perdagangan

| Laporan             | Deskripsi                 |
| ------------------- | ------------------------- |
| Penjualan Harian    | Detail penjualan per hari |
| Ringkasan Penjualan | Summary per periode       |
| Pergerakan Stok     | In-Out stok               |
| Stok Menipis        | Produk perlu reorder      |
| Profit Margin       | Keuntungan per produk     |

### 9.5 Cara Mengexport Laporan

1. Generate laporan yang diinginkan
2. Klik tombol **Export**
3. Pilih format:
   - **Excel**: Untuk analisis lebih lanjut
   - **PDF**: Untuk arsip dan cetak
4. File akan terdownload

---

## 10. Pengaturan

### 10.1 Profil Koperasi

**Peran yang diperlukan**: Super Admin

1. Buka menu **Pengaturan** → **Profil Koperasi**
2. Isi informasi:
   - Nama Koperasi
   - Alamat
   - Nomor Telepon
   - Email
   - Nomor Badan Hukum
   - Logo (untuk kop surat)
3. Klik **Simpan**

### 10.2 Manajemen Pengguna

**Peran yang diperlukan**: Super Admin

#### Menambah Pengguna

1. Buka menu **Pengaturan** → **Pengguna**
2. Klik **Tambah Pengguna**
3. Isi data pengguna:
   - Nama
   - Email (untuk login)
   - Peran/Role
   - Cabang (jika multi-cabang)
4. Klik **Simpan**
5. Password sementara dikirim ke email

#### Menonaktifkan Pengguna

1. Cari pengguna yang akan dinonaktifkan
2. Klik **Edit**
3. Ubah status menjadi **Tidak Aktif**
4. Klik **Simpan**

### 10.3 Konfigurasi Produk Simpanan/Pinjaman

**Peran yang diperlukan**: Super Admin, Manager

1. Buka menu **Pengaturan** → **Produk Keuangan**
2. Pilih tab **Simpanan** atau **Pinjaman**
3. Klik produk untuk edit atau **Tambah Produk**
4. Konfigurasi sesuai kebutuhan
5. Klik **Simpan**

### 10.4 Periode Fiskal

**Peran yang diperlukan**: Akuntan, Super Admin

1. Buka menu **Pengaturan** → **Periode Fiskal**
2. Untuk membuat periode baru: Klik **Tambah Periode**
3. Untuk menutup periode:
   - Klik periode yang akan ditutup
   - Klik **Tutup Periode**
   - Sistem akan membuat jurnal penutup
   - Konfirmasi penutupan

> ⚠️ **Perhatian**: Periode yang sudah ditutup tidak dapat dibuka kembali

---

## 11. FAQ

### Umum

**Q: Bagaimana jika lupa password?**
A: Gunakan fitur "Lupa Password" di halaman login. Link reset akan dikirim ke email terdaftar.

**Q: Berapa lama sesi login aktif?**
A: Sesi akan expired setelah 8 jam tidak aktif. Anda perlu login kembali.

**Q: Apakah bisa akses dari HP?**
A: Ya, sistem responsif dan bisa diakses dari browser HP, namun pengalaman terbaik di desktop/laptop.

### Anggota

**Q: Apakah anggota bisa mendaftar sendiri?**
A: Tidak untuk MVP. Pendaftaran harus melalui staff koperasi.

**Q: Bagaimana jika NIK salah saat pendaftaran?**
A: NIK hanya bisa diperbaiki sebelum anggota disetujui. Setelah disetujui, hubungi Admin.

### Simpanan

**Q: Mengapa tidak bisa tarik Simpanan Pokok?**
A: Simpanan Pokok adalah modal anggota yang tidak dapat ditarik selama masih menjadi anggota.

**Q: Berapa limit penarikan harian?**
A: Tergantung konfigurasi produk. Lihat detail produk simpanan atau tanyakan ke Manager.

### Pinjaman

**Q: Berapa lama proses persetujuan pinjaman?**
A: Tergantung jumlah dan kebijakan. Umumnya 1-3 hari kerja.

**Q: Apakah bisa melunasi sebelum jatuh tempo?**
A: Ya, gunakan fitur Pelunasan Dipercepat. Tidak ada penalti pelunasan dini.

**Q: Bagaimana jika anggota telat bayar?**
A: Sistem akan menghitung denda sesuai konfigurasi produk. Denda dibayar bersamaan dengan angsuran.

---

## 12. Troubleshooting

### Masalah Login

| Masalah                     | Solusi                                                           |
| --------------------------- | ---------------------------------------------------------------- |
| "Email atau password salah" | Periksa kembali email dan password. Perhatikan huruf besar/kecil |
| "Akun terkunci"             | Tunggu 30 menit atau hubungi Admin untuk reset                   |
| "Akun tidak aktif"          | Hubungi Admin untuk mengaktifkan kembali                         |
| Tidak menerima email reset  | Cek folder spam. Pastikan email benar                            |

### Masalah Transaksi

| Masalah                 | Solusi                                                         |
| ----------------------- | -------------------------------------------------------------- |
| "Saldo tidak mencukupi" | Periksa saldo tersedia (dikurangi saldo minimum)               |
| "Melebihi limit harian" | Transaksi ditolak. Lanjutkan besok atau minta override Manager |
| Transaksi pending lama  | Refresh halaman. Jika masih pending, hubungi IT                |
| Struk tidak tercetak    | Periksa koneksi printer. Cetak ulang dari riwayat transaksi    |

### Masalah Laporan

| Masalah              | Solusi                                            |
| -------------------- | ------------------------------------------------- |
| Laporan loading lama | Coba filter periode yang lebih pendek             |
| Data tidak muncul    | Pastikan filter tanggal benar. Refresh halaman    |
| Export gagal         | Coba format lain (Excel/PDF). Clear browser cache |

### Masalah Umum

| Masalah                  | Solusi                                                 |
| ------------------------ | ------------------------------------------------------ |
| Halaman tidak responsive | Refresh browser (Ctrl+F5 atau Cmd+Shift+R)             |
| Menu tidak muncul        | Periksa role/permission Anda. Hubungi Admin jika salah |
| Error "Session expired"  | Login kembali                                          |
| Tampilan berantakan      | Clear browser cache. Gunakan browser yang didukung     |

---

## Kontak Support

Jika mengalami masalah yang tidak terselesaikan:

- **Email**: support@[koperasi].com
- **Telepon**: [Nomor Telepon]
- **Jam Operasional**: Senin - Jumat, 08:00 - 17:00 WIB

---

## Riwayat Revisi

| Versi | Tanggal    | Penulis  | Perubahan    |
| ----- | ---------- | -------- | ------------ |
| 1.0   | 03/02/2026 | [Author] | Dokumen awal |

---

_Akhir Panduan Pengguna_
