# Testing Documentation

# Koperasi Dagang - Dokumentasi Pengujian

---

## Informasi Dokumen

|                   |                                               |
| ----------------- | --------------------------------------------- |
| **Judul Dokumen** | Dokumentasi Pengujian (Testing Documentation) |
| **Versi**         | 1.0                                           |
| **Tanggal**       | 3 Februari 2026                               |
| **PRD Reference** | [prd.md](./prd.md)                            |
| **FSD Reference** | [fsd.md](./fsd.md)                            |
| **Author**        | [TBD]                                         |

---

## Daftar Isi

1. [Pendahuluan](#1-pendahuluan)
2. [Strategi Pengujian](#2-strategi-pengujian)
3. [Test Cases - Otentikasi](#3-test-cases---otentikasi)
4. [Test Cases - Manajemen Anggota](#4-test-cases---manajemen-anggota)
5. [Test Cases - Simpanan](#5-test-cases---simpanan)
6. [Test Cases - Pinjaman](#6-test-cases---pinjaman)
7. [Test Cases - Perdagangan/POS](#7-test-cases---perdaganganpos)
8. [Test Cases - Akuntansi](#8-test-cases---akuntansi)
9. [Test Cases - Laporan](#9-test-cases---laporan)
10. [UAT Scenarios](#10-uat-scenarios)
11. [Test Data](#11-test-data)
12. [Defect Tracking](#12-defect-tracking)

---

## 1. Pendahuluan

### 1.1 Tujuan

Dokumen ini berisi spesifikasi pengujian untuk sistem Koperasi Dagang, meliputi:

- Test cases untuk setiap modul
- Skenario UAT (User Acceptance Testing)
- Data uji yang diperlukan
- Template pelaporan defect

### 1.2 Ruang Lingkup

| Jenis Pengujian         | Deskripsi                                            |
| ----------------------- | ---------------------------------------------------- |
| **Unit Testing**        | Pengujian fungsi individual (Services, Repositories) |
| **Feature Testing**     | Pengujian endpoint HTTP dan workflow                 |
| **Integration Testing** | Pengujian integrasi antar modul                      |
| **UAT**                 | Pengujian penerimaan pengguna                        |
| **Regression Testing**  | Pengujian setelah perubahan/perbaikan                |

### 1.3 Environment

| Environment | Tujuan        | URL                  |
| ----------- | ------------- | -------------------- |
| Development | Pengembangan  | localhost            |
| Staging     | Testing & UAT | staging.[domain].com |
| Production  | Live          | [domain].com         |

### 1.4 Kriteria Kelulusan

| Kriteria            | Target                  |
| ------------------- | ----------------------- |
| Test Case Pass Rate | ≥ 95%                   |
| Critical/High Bugs  | 0                       |
| Medium Bugs         | ≤ 5 (dengan workaround) |
| Code Coverage       | ≥ 80%                   |

---

## 2. Strategi Pengujian

### 2.1 Prioritas Pengujian

| Prioritas     | Modul                          | Alasan                            |
| ------------- | ------------------------------ | --------------------------------- |
| P1 (Critical) | Otentikasi, Simpanan, Pinjaman | Core business, transaksi keuangan |
| P2 (High)     | Anggota, POS, Akuntansi        | Operasional harian                |
| P3 (Medium)   | Laporan, Dashboard             | Supporting features               |
| P4 (Low)      | Settings, User Management      | Admin functions                   |

### 2.2 Jenis Test

```
┌─────────────────────────────────────────────────────────┐
│                    TESTING PYRAMID                       │
├─────────────────────────────────────────────────────────┤
│                                                         │
│                      ┌───────────┐                      │
│                      │    E2E    │  10%                 │
│                      │   (UAT)   │                      │
│                      └───────────┘                      │
│                   ┌───────────────┐                     │
│                   │  Integration  │  20%                │
│                   │    Tests      │                     │
│                   └───────────────┘                     │
│              ┌──────────────────────┐                   │
│              │    Feature Tests     │  30%              │
│              │    (HTTP/API)        │                   │
│              └──────────────────────┘                   │
│         ┌─────────────────────────────┐                 │
│         │       Unit Tests            │  40%            │
│         │   (Services, Actions)       │                 │
│         └─────────────────────────────┘                 │
│                                                         │
└─────────────────────────────────────────────────────────┘
```

### 2.3 Tools

| Tool               | Penggunaan             |
| ------------------ | ---------------------- |
| Pest PHP           | Unit & Feature Testing |
| Laravel Dusk       | Browser Testing (E2E)  |
| Postman            | API Testing            |
| MySQL (Testing DB) | Test Database          |
| Factory & Seeder   | Test Data Generation   |

---

## 3. Test Cases - Otentikasi

### TC-AUTH-001: Login dengan Kredensial Valid

| Field             | Value                                             |
| ----------------- | ------------------------------------------------- |
| **Test Case ID**  | TC-AUTH-001                                       |
| **Module**        | Authentication                                    |
| **Priority**      | P1 - Critical                                     |
| **Preconditions** | User account exists and is active                 |
| **Test Data**     | Email: teller@koperasi.com, Password: Password123 |

**Steps:**

| Step | Action                 | Expected Result                                     |
| ---- | ---------------------- | --------------------------------------------------- |
| 1    | Navigate to login page | Login form displayed                                |
| 2    | Enter valid email      | Email accepted                                      |
| 3    | Enter valid password   | Password field shows dots                           |
| 4    | Click "Login" button   | User redirected to dashboard                        |
| 5    | Verify dashboard       | User name displayed, role-appropriate widgets shown |

**Postconditions:** User session created, activity logged

---

### TC-AUTH-002: Login dengan Password Salah

| Field             | Value                                               |
| ----------------- | --------------------------------------------------- |
| **Test Case ID**  | TC-AUTH-002                                         |
| **Module**        | Authentication                                      |
| **Priority**      | P1 - Critical                                       |
| **Preconditions** | User account exists                                 |
| **Test Data**     | Email: teller@koperasi.com, Password: WrongPassword |

**Steps:**

| Step | Action                    | Expected Result                            |
| ---- | ------------------------- | ------------------------------------------ |
| 1    | Navigate to login page    | Login form displayed                       |
| 2    | Enter valid email         | Email accepted                             |
| 3    | Enter wrong password      | Password entered                           |
| 4    | Click "Login" button      | Error message: "Email atau password salah" |
| 5    | Verify user not logged in | Still on login page                        |

---

### TC-AUTH-003: Account Lockout setelah 5x Gagal

| Field             | Value                                          |
| ----------------- | ---------------------------------------------- |
| **Test Case ID**  | TC-AUTH-003                                    |
| **Module**        | Authentication                                 |
| **Priority**      | P1 - Critical                                  |
| **Preconditions** | User account exists, not locked                |
| **Test Data**     | Email: teller@koperasi.com, Password: Wrong1-5 |

**Steps:**

| Step | Action                                       | Expected Result                                  |
| ---- | -------------------------------------------- | ------------------------------------------------ |
| 1-5  | Attempt login with wrong password 5 times    | Error message each time                          |
| 6    | Attempt 6th login                            | Error: "Akun terkunci. Coba lagi dalam 30 menit" |
| 7    | Attempt with correct password                | Still locked, same error message                 |
| 8    | Wait 30 minutes, retry with correct password | Login successful                                 |

---

### TC-AUTH-004: Password Reset

| Field             | Value                                |
| ----------------- | ------------------------------------ |
| **Test Case ID**  | TC-AUTH-004                          |
| **Module**        | Authentication                       |
| **Priority**      | P2 - High                            |
| **Preconditions** | User account exists with valid email |

**Steps:**

| Step | Action                           | Expected Result               |
| ---- | -------------------------------- | ----------------------------- |
| 1    | Click "Lupa Password" link       | Reset form displayed          |
| 2    | Enter registered email           | Email accepted                |
| 3    | Click "Kirim Link Reset"         | Success message, email sent   |
| 4    | Check email, click reset link    | Password reset form displayed |
| 5    | Enter new password (Password456) | Accepted                      |
| 6    | Confirm new password             | Passwords match               |
| 7    | Click "Simpan Password"          | Success message               |
| 8    | Login with new password          | Login successful              |

---

### TC-AUTH-005: Access Control - Unauthorized Access

| Field             | Value                                               |
| ----------------- | --------------------------------------------------- |
| **Test Case ID**  | TC-AUTH-005                                         |
| **Module**        | Authorization                                       |
| **Priority**      | P1 - Critical                                       |
| **Preconditions** | Logged in as Teller (no user management permission) |

**Steps:**

| Step | Action                                | Expected Result                     |
| ---- | ------------------------------------- | ----------------------------------- |
| 1    | Login as Teller                       | Dashboard shown                     |
| 2    | Try to access /settings/users         | 403 Forbidden error                 |
| 3    | Verify error page                     | "Anda tidak memiliki akses" message |
| 4    | Try direct URL /settings/users/create | 403 Forbidden error                 |

---

## 4. Test Cases - Manajemen Anggota

### TC-MEM-001: Pendaftaran Anggota Baru - Sukses

| Field             | Value                              |
| ----------------- | ---------------------------------- |
| **Test Case ID**  | TC-MEM-001                         |
| **Module**        | Member Management                  |
| **Priority**      | P1 - Critical                      |
| **Preconditions** | Logged in as Member Services staff |
| **Test Data**     | See Test Data section              |

**Steps:**

| Step | Action                             | Expected Result                                       |
| ---- | ---------------------------------- | ----------------------------------------------------- |
| 1    | Navigate to Anggota → Pendaftaran  | Registration form displayed                           |
| 2    | Enter NIK: 3275012345678901        | Accepted, 16 digits                                   |
| 3    | Enter Name: Ahmad Wijaya           | Accepted                                              |
| 4    | Select Gender: L                   | Selected                                              |
| 5    | Enter Address: Jl. Merdeka No. 123 | Accepted                                              |
| 6    | Enter Phone: 081234567890          | Accepted                                              |
| 7    | Select Member Type: Regular        | Selected                                              |
| 8    | Upload KTP photo                   | File uploaded                                         |
| 9    | Upload member photo                | File uploaded                                         |
| 10   | Click "Kirim untuk Persetujuan"    | Success message, member created with status "pending" |
| 11   | Verify member number generated     | Format: MBR-2026-XXXXX                                |

**Postconditions:** Member record created, pending approval

---

### TC-MEM-002: Pendaftaran Anggota - NIK Duplikat

| Field             | Value                                           |
| ----------------- | ----------------------------------------------- |
| **Test Case ID**  | TC-MEM-002                                      |
| **Module**        | Member Management                               |
| **Priority**      | P1 - Critical                                   |
| **Preconditions** | Member with NIK 3275012345678901 already exists |

**Steps:**

| Step | Action                               | Expected Result              |
| ---- | ------------------------------------ | ---------------------------- |
| 1    | Navigate to registration form        | Form displayed               |
| 2    | Enter existing NIK: 3275012345678901 | Entered                      |
| 3    | Fill other required fields           | Completed                    |
| 4    | Click "Kirim"                        | Error: "NIK sudah terdaftar" |
| 5    | Verify link to existing member       | Link to member profile shown |

---

### TC-MEM-003: Persetujuan Anggota

| Field             | Value                                                                |
| ----------------- | -------------------------------------------------------------------- |
| **Test Case ID**  | TC-MEM-003                                                           |
| **Module**        | Member Management                                                    |
| **Priority**      | P1 - Critical                                                        |
| **Preconditions** | Logged in as Manager, pending member exists with Simpanan Pokok paid |

**Steps:**

| Step | Action                                    | Expected Result                    |
| ---- | ----------------------------------------- | ---------------------------------- |
| 1    | Navigate to Anggota → Persetujuan Pending | List of pending members shown      |
| 2    | Click on pending member                   | Member details displayed           |
| 3    | Verify all documents uploaded             | Documents visible                  |
| 4    | Verify Simpanan Pokok status              | Marked as paid                     |
| 5    | Click "Setujui"                           | Confirmation dialog                |
| 6    | Confirm approval                          | Success message                    |
| 7    | Verify member status                      | Status changed to "active"         |
| 8    | Verify savings accounts created           | Accounts visible in member profile |

---

### TC-MEM-004: Pencarian Anggota

| Field             | Value                            |
| ----------------- | -------------------------------- |
| **Test Case ID**  | TC-MEM-004                       |
| **Module**        | Member Management                |
| **Priority**      | P2 - High                        |
| **Preconditions** | Multiple members exist in system |

**Steps:**

| Step | Action                      | Expected Result                            |
| ---- | --------------------------- | ------------------------------------------ |
| 1    | Navigate to Anggota → Cari  | Search form displayed                      |
| 2    | Enter partial name: "Ahmad" | Entered                                    |
| 3    | Click Search                | Results shown within 2 seconds             |
| 4    | Verify results              | All members with "Ahmad" in name displayed |
| 5    | Clear and search by NIK     | Exact match found                          |
| 6    | Filter by status "Active"   | Only active members shown                  |

---

### TC-MEM-005: Pengunduran Diri Anggota - Dengan Pinjaman Aktif

| Field             | Value                                           |
| ----------------- | ----------------------------------------------- |
| **Test Case ID**  | TC-MEM-005                                      |
| **Module**        | Member Management                               |
| **Priority**      | P2 - High                                       |
| **Preconditions** | Member has active loan with outstanding balance |

**Steps:**

| Step | Action                               | Expected Result                                                                                          |
| ---- | ------------------------------------ | -------------------------------------------------------------------------------------------------------- |
| 1    | Open member profile                  | Profile displayed                                                                                        |
| 2    | Click Aksi → Proses Pengunduran Diri | Initiate resignation                                                                                     |
| 3    | System checks outstanding loans      | Loan found                                                                                               |
| 4    | Verify error message                 | "Tidak dapat mengundurkan diri. Terdapat pinjaman aktif: LN-2026-XXXXX, saldo outstanding: Rp X.XXX.XXX" |
| 5    | Resignation blocked                  | Cannot proceed                                                                                           |

---

## 5. Test Cases - Simpanan

### TC-SAV-001: Setoran Simpanan Sukarela - Sukses

| Field             | Value                                      |
| ----------------- | ------------------------------------------ |
| **Test Case ID**  | TC-SAV-001                                 |
| **Module**        | Savings                                    |
| **Priority**      | P1 - Critical                              |
| **Preconditions** | Active member exists, logged in as Teller  |
| **Test Data**     | Member: MBR-2024-00123, Amount: Rp 500.000 |

**Steps:**

| Step | Action                                  | Expected Result                         |
| ---- | --------------------------------------- | --------------------------------------- |
| 1    | Navigate to Simpanan → Setoran          | Deposit form displayed                  |
| 2    | Search and select member MBR-2024-00123 | Member selected, accounts shown         |
| 3    | Select "Simpanan Sukarela" account      | Account selected, current balance shown |
| 4    | Enter amount: 500000                    | Formatted as Rp 500.000                 |
| 5    | Click "Proses Setoran"                  | Confirmation dialog                     |
| 6    | Verify details in confirmation          | Member, account, amount correct         |
| 7    | Click "Konfirmasi"                      | Processing                              |
| 8    | Verify success message                  | "Setoran berhasil"                      |
| 9    | Verify new balance                      | Previous balance + 500.000              |
| 10   | Click "Cetak Bukti"                     | Receipt PDF generated                   |
| 11   | Verify transaction in history           | Transaction logged with correct details |

**Postconditions:** Balance updated, GL posted, audit logged

---

### TC-SAV-002: Setoran di Bawah Minimum

| Field             | Value                                              |
| ----------------- | -------------------------------------------------- |
| **Test Case ID**  | TC-SAV-002                                         |
| **Module**        | Savings                                            |
| **Priority**      | P1 - Critical                                      |
| **Preconditions** | Minimum deposit for Simpanan Sukarela is Rp 50.000 |

**Steps:**

| Step | Action                              | Expected Result             |
| ---- | ----------------------------------- | --------------------------- |
| 1    | Navigate to Simpanan → Setoran      | Form displayed              |
| 2    | Select member and Simpanan Sukarela | Account selected            |
| 3    | Enter amount: 25000                 | Amount entered              |
| 4    | Click "Proses Setoran"              | Validation error            |
| 5    | Verify error message                | "Minimal setoran Rp 50.000" |
| 6    | Transaction not processed           | Balance unchanged           |

---

### TC-SAV-003: Penarikan Simpanan - Sukses

| Field             | Value                                                                     |
| ----------------- | ------------------------------------------------------------------------- |
| **Test Case ID**  | TC-SAV-003                                                                |
| **Module**        | Savings                                                                   |
| **Priority**      | P1 - Critical                                                             |
| **Preconditions** | Member has Simpanan Sukarela balance Rp 2.000.000, min balance Rp 100.000 |
| **Test Data**     | Withdrawal amount: Rp 500.000                                             |

**Steps:**

| Step | Action                             | Expected Result              |
| ---- | ---------------------------------- | ---------------------------- |
| 1    | Navigate to Simpanan → Penarikan   | Withdrawal form              |
| 2    | Select member and account          | Account shown with balance   |
| 3    | Verify available balance displayed | Rp 1.900.000 (balance - min) |
| 4    | Enter amount: 500000               | Amount accepted              |
| 5    | Click "Proses Penarikan"           | Confirmation                 |
| 6    | Confirm                            | Success                      |
| 7    | Verify new balance                 | Rp 1.500.000                 |
| 8    | Print receipt                      | Receipt generated            |

---

### TC-SAV-004: Penarikan Melebihi Saldo

| Field             | Value                                               |
| ----------------- | --------------------------------------------------- |
| **Test Case ID**  | TC-SAV-004                                          |
| **Module**        | Savings                                             |
| **Priority**      | P1 - Critical                                       |
| **Preconditions** | Member balance Rp 2.000.000, min balance Rp 100.000 |

**Steps:**

| Step | Action                      | Expected Result                                           |
| ---- | --------------------------- | --------------------------------------------------------- |
| 1    | Navigate to withdrawal form | Form displayed                                            |
| 2    | Select member and account   | Balance shown                                             |
| 3    | Enter amount: 2500000       | Amount entered                                            |
| 4    | Click "Proses Penarikan"    | Validation error                                          |
| 5    | Verify error                | "Saldo tidak mencukupi. Maksimal penarikan: Rp 1.900.000" |

---

### TC-SAV-005: Penarikan Simpanan Pokok - Ditolak

| Field             | Value                             |
| ----------------- | --------------------------------- |
| **Test Case ID**  | TC-SAV-005                        |
| **Module**        | Savings                           |
| **Priority**      | P1 - Critical                     |
| **Preconditions** | Active member with Simpanan Pokok |

**Steps:**

| Step | Action                       | Expected Result                      |
| ---- | ---------------------------- | ------------------------------------ |
| 1    | Navigate to withdrawal form  | Form displayed                       |
| 2    | Select member                | Accounts listed                      |
| 3    | Try to select Simpanan Pokok | Account disabled/not selectable      |
| 4    | Verify message               | "Simpanan Pokok tidak dapat ditarik" |

---

### TC-SAV-006: Perhitungan Bunga Simpanan

| Field             | Value                                                                   |
| ----------------- | ----------------------------------------------------------------------- |
| **Test Case ID**  | TC-SAV-006                                                              |
| **Module**        | Savings                                                                 |
| **Priority**      | P2 - High                                                               |
| **Preconditions** | End of month, members have Simpanan Sukarela with interest rate 3% p.a. |

**Steps:**

| Step | Action                                   | Expected Result                                 |
| ---- | ---------------------------------------- | ----------------------------------------------- |
| 1    | Login as Accountant                      | Dashboard                                       |
| 2    | Navigate to Simpanan → Perhitungan Bunga | Interest calculation form                       |
| 3    | Select period (current month)            | Period selected                                 |
| 4    | Click "Preview"                          | Preview of interest amounts shown               |
| 5    | Verify calculation                       | Interest = (Balance × 3% / 12) per account      |
| 6    | Click "Proses Perhitungan"               | Processing                                      |
| 7    | Verify success                           | Interest posted to all accounts                 |
| 8    | Check sample account                     | Interest transaction visible, balance increased |

---

## 6. Test Cases - Pinjaman

### TC-LOAN-001: Pengajuan Pinjaman - Sukses

| Field             | Value                                                      |
| ----------------- | ---------------------------------------------------------- |
| **Test Case ID**  | TC-LOAN-001                                                |
| **Module**        | Loan                                                       |
| **Priority**      | P1 - Critical                                              |
| **Preconditions** | Active member, no NPL history, logged in as Loan Officer   |
| **Test Data**     | Amount: Rp 10.000.000, Term: 12 months, Product: Produktif |

**Steps:**

| Step | Action                                | Expected Result                                        |
| ---- | ------------------------------------- | ------------------------------------------------------ |
| 1    | Navigate to Pinjaman → Pengajuan Baru | Application form                                       |
| 2    | Search and select member              | Member selected, eligibility shown                     |
| 3    | Verify "Eligible" status              | Green checkmark                                        |
| 4    | Select product: Pinjaman Produktif    | Product selected, rates shown                          |
| 5    | Enter amount: 10000000                | Amount within limits                                   |
| 6    | Enter term: 12 months                 | Term accepted                                          |
| 7    | Enter purpose: Modal usaha            | Purpose entered                                        |
| 8    | System calculates                     | Installment: ~Rp 916.667, Total interest: Rp 1.000.000 |
| 9    | Click "Kirim untuk Analisis"          | Success                                                |
| 10   | Verify loan number generated          | LN-2026-XXXXX                                          |
| 11   | Verify status                         | "pending" or "analyzing"                               |

---

### TC-LOAN-002: Pengajuan Pinjaman - Anggota Tidak Eligible

| Field             | Value                                            |
| ----------------- | ------------------------------------------------ |
| **Test Case ID**  | TC-LOAN-002                                      |
| **Module**        | Loan                                             |
| **Priority**      | P1 - Critical                                    |
| **Preconditions** | Member has existing NPL (loan > 90 days overdue) |

**Steps:**

| Step | Action                            | Expected Result                      |
| ---- | --------------------------------- | ------------------------------------ |
| 1    | Navigate to loan application      | Form displayed                       |
| 2    | Search and select member with NPL | Member selected                      |
| 3    | Verify eligibility status         | "Tidak Eligible" with reason         |
| 4    | Reason displayed                  | "Memiliki pinjaman bermasalah (NPL)" |
| 5    | Try to proceed                    | Submit button disabled               |

---

### TC-LOAN-003: Analisis Kredit

| Field             | Value                                         |
| ----------------- | --------------------------------------------- |
| **Test Case ID**  | TC-LOAN-003                                   |
| **Module**        | Loan                                          |
| **Priority**      | P1 - Critical                                 |
| **Preconditions** | Loan application exists with status "pending" |

**Steps:**

| Step | Action                                  | Expected Result                             |
| ---- | --------------------------------------- | ------------------------------------------- |
| 1    | Navigate to Pinjaman → Analisis Pending | List of pending loans                       |
| 2    | Select loan application                 | Analysis form displayed                     |
| 3    | Review member info                      | Member data shown                           |
| 4    | Enter monthly income: 5000000           | Entered                                     |
| 5    | System shows existing obligations       | Any existing loans listed                   |
| 6    | System calculates DTI                   | DTI = (New installment + existing) / income |
| 7    | Fill 5C analysis form                   | All sections completed                      |
| 8    | Select recommendation: "Disetujui"      | Recommendation recorded                     |
| 9    | Click "Kirim untuk Persetujuan"         | Success                                     |
| 10   | Verify status change                    | Status: "committee" or next approval level  |

---

### TC-LOAN-004: Persetujuan Pinjaman

| Field             | Value                                       |
| ----------------- | ------------------------------------------- |
| **Test Case ID**  | TC-LOAN-004                                 |
| **Module**        | Loan                                        |
| **Priority**      | P1 - Critical                               |
| **Preconditions** | Logged in as Manager, loan waiting approval |

**Steps:**

| Step | Action                                     | Expected Result            |
| ---- | ------------------------------------------ | -------------------------- |
| 1    | Navigate to Pinjaman → Persetujuan Pending | Pending loans listed       |
| 2    | Select loan                                | Details and analysis shown |
| 3    | Review credit analysis                     | All 5C data visible        |
| 4    | Review DTI ratio                           | Risk rating displayed      |
| 5    | Click "Setujui"                            | Approval form              |
| 6    | Add comments (optional)                    | Comments entered           |
| 7    | Confirm approval                           | Success                    |
| 8    | Verify status                              | Status: "approved"         |

---

### TC-LOAN-005: Pencairan Pinjaman ke Simpanan

| Field             | Value                           |
| ----------------- | ------------------------------- |
| **Test Case ID**  | TC-LOAN-005                     |
| **Module**        | Loan                            |
| **Priority**      | P1 - Critical                   |
| **Preconditions** | Approved loan, agreement signed |

**Steps:**

| Step | Action                                | Expected Result                                           |
| ---- | ------------------------------------- | --------------------------------------------------------- |
| 1    | Navigate to Pinjaman → Pencairan      | Approved loans listed                                     |
| 2    | Select approved loan                  | Disbursement form                                         |
| 3    | Verify amounts                        | Principal: 10.000.000, Admin fee: 100.000, Net: 9.900.000 |
| 4    | Select method: "Ke Rekening Simpanan" | Method selected                                           |
| 5    | Select target savings account         | Account selected                                          |
| 6    | Click "Proses Pencairan"              | Confirmation                                              |
| 7    | Confirm                               | Processing                                                |
| 8    | Verify success                        | Success message                                           |
| 9    | Check savings account                 | Balance increased by Rp 9.900.000                         |
| 10   | Check loan status                     | Status: "active"                                          |
| 11   | Verify schedule generated             | 12 installments listed                                    |
| 12   | Print documents                       | Agreement + Schedule + Receipt                            |

---

### TC-LOAN-006: Pembayaran Angsuran

| Field             | Value                               |
| ----------------- | ----------------------------------- |
| **Test Case ID**  | TC-LOAN-006                         |
| **Module**        | Loan                                |
| **Priority**      | P1 - Critical                       |
| **Preconditions** | Active loan with due installment    |
| **Test Data**     | Payment: Rp 916.667 (1 installment) |

**Steps:**

| Step | Action                            | Expected Result                        |
| ---- | --------------------------------- | -------------------------------------- |
| 1    | Navigate to Pinjaman → Pembayaran | Payment form                           |
| 2    | Search loan by number or member   | Loan found                             |
| 3    | System shows                      | Due amount, outstanding, any penalties |
| 4    | Enter payment amount: 916667      | Amount entered                         |
| 5    | Select payment method: Cash       | Method selected                        |
| 6    | Click "Proses Pembayaran"         | Confirmation                           |
| 7    | Verify allocation                 | Principal: ~833.333, Interest: ~83.334 |
| 8    | Confirm                           | Success                                |
| 9    | Verify schedule update            | Installment marked as "paid"           |
| 10   | Verify outstanding decrease       | Outstanding principal reduced          |
| 11   | Print receipt                     | Receipt generated                      |

---

### TC-LOAN-007: Laporan Aging Pinjaman

| Field             | Value                                        |
| ----------------- | -------------------------------------------- |
| **Test Case ID**  | TC-LOAN-007                                  |
| **Module**        | Loan                                         |
| **Priority**      | P2 - High                                    |
| **Preconditions** | Multiple loans with various overdue statuses |

**Steps:**

| Step | Action                               | Expected Result                               |
| ---- | ------------------------------------ | --------------------------------------------- |
| 1    | Navigate to Pinjaman → Laporan Aging | Aging report                                  |
| 2    | Select date: today                   | Date selected                                 |
| 3    | Generate report                      | Report displayed                              |
| 4    | Verify categories                    | Current, DPK, Kurang Lancar, Diragukan, Macet |
| 5    | Verify loan classification           | Days overdue matches category                 |
| 6    | Click on category                    | Detail list shown                             |
| 7    | Export to Excel                      | Excel downloaded                              |

---

## 7. Test Cases - Perdagangan/POS

### TC-POS-001: Penjualan Tunai - Non-Anggota

| Field             | Value                                        |
| ----------------- | -------------------------------------------- |
| **Test Case ID**  | TC-POS-001                                   |
| **Module**        | POS                                          |
| **Priority**      | P1 - Critical                                |
| **Preconditions** | Products in stock, logged in as Teller       |
| **Test Data**     | Beras 5kg (Rp 75.000), Minyak 2L (Rp 35.000) |

**Steps:**

| Step | Action                                  | Expected Result         |
| ---- | --------------------------------------- | ----------------------- |
| 1    | Navigate to Perdagangan → Point of Sale | POS interface           |
| 2    | Search "Beras 5kg"                      | Product found           |
| 3    | Add to cart                             | Item added, qty: 1      |
| 4    | Increase qty to 2                       | Subtotal: Rp 150.000    |
| 5    | Search and add "Minyak 2L"              | Item added              |
| 6    | Verify total                            | Total: Rp 185.000       |
| 7    | No member ID entered                    | Regular pricing applied |
| 8    | Enter payment: 200000                   | Change: Rp 15.000       |
| 9    | Click "Bayar & Selesai"                 | Processing              |
| 10   | Verify success                          | Sale completed          |
| 11   | Print receipt                           | Receipt generated       |
| 12   | Check inventory                         | Beras: -2, Minyak: -1   |

---

### TC-POS-002: Penjualan dengan Harga Anggota

| Field             | Value                                          |
| ----------------- | ---------------------------------------------- |
| **Test Case ID**  | TC-POS-002                                     |
| **Module**        | POS                                            |
| **Priority**      | P2 - High                                      |
| **Preconditions** | Product has member price, member is active     |
| **Test Data**     | Beras 5kg: Regular Rp 75.000, Member Rp 72.000 |

**Steps:**

| Step | Action                          | Expected Result             |
| ---- | ------------------------------- | --------------------------- |
| 1    | Open POS                        | Interface ready             |
| 2    | Add Beras 5kg                   | Regular price: Rp 75.000    |
| 3    | Enter member ID: MBR-2024-00123 | Member verified             |
| 4    | Verify price change             | Price: Rp 72.000            |
| 5    | Total updated                   | New total with member price |
| 6    | Complete sale                   | Success                     |
| 7    | Verify receipt                  | Shows member discount       |

---

### TC-POS-003: Penjualan Stok Tidak Cukup

| Field             | Value                  |
| ----------------- | ---------------------- |
| **Test Case ID**  | TC-POS-003             |
| **Module**        | POS                    |
| **Priority**      | P1 - Critical          |
| **Preconditions** | Product stock: 5 units |

**Steps:**

| Step | Action                       | Expected Result                             |
| ---- | ---------------------------- | ------------------------------------------- |
| 1    | Open POS                     | Interface ready                             |
| 2    | Add product                  | Added with qty 1                            |
| 3    | Try to set qty: 10           | Error: "Stok tidak mencukupi (tersedia: 5)" |
| 4    | Qty remains at max available | Qty: 5                                      |
| 5    | Sale can proceed with 5      | Sale completes                              |

---

### TC-POS-004: Penerimaan Barang

| Field             | Value                                   |
| ----------------- | --------------------------------------- |
| **Test Case ID**  | TC-POS-004                              |
| **Module**        | Inventory                               |
| **Priority**      | P2 - High                               |
| **Preconditions** | PO exists, logged in as Warehouse Staff |

**Steps:**

| Step | Action                                      | Expected Result                    |
| ---- | ------------------------------------------- | ---------------------------------- |
| 1    | Navigate to Perdagangan → Penerimaan Barang | Receipt form                       |
| 2    | Select PO from list                         | PO items loaded                    |
| 3    | Enter received quantities                   | Quantities entered                 |
| 4    | Enter supplier invoice number               | Invoice recorded                   |
| 5    | Click "Posting"                             | Confirmation                       |
| 6    | Confirm                                     | Success                            |
| 7    | Verify inventory update                     | Stock quantities increased         |
| 8    | Verify PO status                            | Updated to "received" or "partial" |
| 9    | Check stock movement log                    | Movement recorded                  |

---

## 8. Test Cases - Akuntansi

### TC-ACC-001: Jurnal Manual - Balanced

| Field             | Value                                       |
| ----------------- | ------------------------------------------- |
| **Test Case ID**  | TC-ACC-001                                  |
| **Module**        | Accounting                                  |
| **Priority**      | P1 - Critical                               |
| **Preconditions** | Open fiscal period, logged in as Accountant |

**Steps:**

| Step | Action                                           | Expected Result             |
| ---- | ------------------------------------------------ | --------------------------- |
| 1    | Navigate to Akuntansi → Jurnal                   | Journal form                |
| 2    | Click "Jurnal Baru"                              | New entry form              |
| 3    | Enter date (within open period)                  | Date accepted               |
| 4    | Enter description                                | Description entered         |
| 5    | Add line: Debit - Biaya Operasional - Rp 500.000 | Line added                  |
| 6    | Add line: Credit - Kas - Rp 500.000              | Line added                  |
| 7    | Verify balance                                   | Debit = Credit = Rp 500.000 |
| 8    | Click "Posting"                                  | Confirmation                |
| 9    | Confirm                                          | Success                     |
| 10   | Verify journal number                            | JE-202602-XXXXX             |
| 11   | Check account balances                           | Updated correctly           |

---

### TC-ACC-002: Jurnal Manual - Unbalanced (Gagal)

| Field            | Value         |
| ---------------- | ------------- |
| **Test Case ID** | TC-ACC-002    |
| **Module**       | Accounting    |
| **Priority**     | P1 - Critical |

**Steps:**

| Step | Action                      | Expected Result                                                |
| ---- | --------------------------- | -------------------------------------------------------------- |
| 1    | Create journal entry        | Form ready                                                     |
| 2    | Add line: Debit Rp 500.000  | Added                                                          |
| 3    | Add line: Credit Rp 400.000 | Added                                                          |
| 4    | Try to post                 | Error: "Jurnal tidak balance. Debit: 500.000, Credit: 400.000" |
| 5    | Cannot save                 | Submit blocked                                                 |

---

### TC-ACC-003: Posting ke Periode Tertutup (Gagal)

| Field             | Value                         |
| ----------------- | ----------------------------- |
| **Test Case ID**  | TC-ACC-003                    |
| **Module**        | Accounting                    |
| **Priority**      | P1 - Critical                 |
| **Preconditions** | January 2026 period is closed |

**Steps:**

| Step | Action                                 | Expected Result                                  |
| ---- | -------------------------------------- | ------------------------------------------------ |
| 1    | Create journal entry                   | Form ready                                       |
| 2    | Enter date: 2026-01-15 (closed period) | Date entered                                     |
| 3    | Fill balance entry                     | Complete                                         |
| 4    | Try to post                            | Error: "Tidak dapat posting ke periode tertutup" |
| 5    | Journal not saved                      | Entry blocked                                    |

---

### TC-ACC-004: Neraca Saldo

| Field            | Value      |
| ---------------- | ---------- |
| **Test Case ID** | TC-ACC-004 |
| **Module**       | Accounting |
| **Priority**     | P2 - High  |

**Steps:**

| Step | Action                               | Expected Result                      |
| ---- | ------------------------------------ | ------------------------------------ |
| 1    | Navigate to Akuntansi → Neraca Saldo | Report form                          |
| 2    | Select period/date                   | Period selected                      |
| 3    | Generate                             | Report displayed                     |
| 4    | Verify all accounts listed           | Accounts with non-zero balance shown |
| 5    | Verify total debit = total credit    | Balanced                             |
| 6    | Export to Excel                      | File downloaded                      |

---

### TC-ACC-005: Laporan Laba Rugi

| Field            | Value      |
| ---------------- | ---------- |
| **Test Case ID** | TC-ACC-005 |
| **Module**       | Accounting |
| **Priority**     | P2 - High  |

**Steps:**

| Step | Action                                 | Expected Result                  |
| ---- | -------------------------------------- | -------------------------------- |
| 1    | Navigate to Laporan → Laporan Keuangan | Selection                        |
| 2    | Select "Laba Rugi"                     | Form ready                       |
| 3    | Select period                          | Period selected                  |
| 4    | Generate                               | Report displayed                 |
| 5    | Verify structure                       | Revenue - Expenses = Net Surplus |
| 6    | Verify revenue accounts                | All revenue types shown          |
| 7    | Verify expense accounts                | All expense types shown          |
| 8    | Verify calculation                     | Totals correct                   |

---

## 9. Test Cases - Laporan

### TC-RPT-001: Export Laporan ke Excel

| Field            | Value      |
| ---------------- | ---------- |
| **Test Case ID** | TC-RPT-001 |
| **Module**       | Reports    |
| **Priority**     | P2 - High  |

**Steps:**

| Step | Action               | Expected Result                    |
| ---- | -------------------- | ---------------------------------- |
| 1    | Generate any report  | Report displayed                   |
| 2    | Click "Export"       | Format options                     |
| 3    | Select "Excel"       | Download starts                    |
| 4    | Open downloaded file | Excel opens with data              |
| 5    | Verify data matches  | All report data present            |
| 6    | Verify formatting    | Columns aligned, numbers formatted |

---

### TC-RPT-002: Export Laporan ke PDF

| Field            | Value      |
| ---------------- | ---------- |
| **Test Case ID** | TC-RPT-002 |
| **Module**       | Reports    |
| **Priority**     | P2 - High  |

**Steps:**

| Step | Action                 | Expected Result              |
| ---- | ---------------------- | ---------------------------- |
| 1    | Generate any report    | Report displayed             |
| 2    | Click "Export" → "PDF" | Download starts              |
| 3    | Open PDF               | PDF viewer opens             |
| 4    | Verify content         | All data visible             |
| 5    | Verify header          | Koperasi name and logo       |
| 6    | Verify footer          | Page numbers, date generated |

---

## 10. UAT Scenarios

### UAT-001: Member Registration to First Deposit

**Scenario:** Complete end-to-end member registration and first deposit

**Actors:** Member Services, Manager, Teller

**Steps:**

| Step | Actor           | Action                               | Expected               |
| ---- | --------------- | ------------------------------------ | ---------------------- |
| 1    | Member Services | Register new member                  | Pending member created |
| 2    | Member Services | Upload KTP and photo                 | Documents attached     |
| 3    | Teller          | Receive Simpanan Pokok payment       | Payment recorded       |
| 4    | Manager         | Approve member                       | Status: Active         |
| 5    | System          | Auto-create savings accounts         | Accounts visible       |
| 6    | Teller          | Process first Simpanan Wajib deposit | Balance updated        |
| 7    | Teller          | Print passbook                       | Passbook generated     |

**Success Criteria:**

- [ ] Member active with member number
- [ ] All savings accounts created
- [ ] Balances correct
- [ ] All documents stored
- [ ] Audit trail complete

---

### UAT-002: Loan Application to Repayment

**Scenario:** Complete loan lifecycle from application to full repayment

**Actors:** Member, Loan Officer, Manager, Teller

**Steps:**

| Step | Actor        | Action                    | Expected            |
| ---- | ------------ | ------------------------- | ------------------- |
| 1    | Loan Officer | Create loan application   | Application pending |
| 2    | Loan Officer | Complete credit analysis  | Risk assessed       |
| 3    | Manager      | Review and approve        | Approved status     |
| 4    | Loan Officer | Disburse to savings       | Funds transferred   |
| 5    | System       | Generate schedule         | 12 installments     |
| 6    | Teller       | Process installment 1-11  | Payments recorded   |
| 7    | Teller       | Process final installment | Loan closed         |

**Success Criteria:**

- [ ] Loan disbursed correctly (principal - fees)
- [ ] Schedule accurate
- [ ] Each payment allocated correctly
- [ ] Final balance zero
- [ ] Loan status: closed
- [ ] GL entries all correct

---

### UAT-003: Daily Trading Operations

**Scenario:** Complete trading day operations

**Actors:** Warehouse Staff, Teller

**Steps:**

| Step | Actor      | Action                                  | Expected               |
| ---- | ---------- | --------------------------------------- | ---------------------- |
| 1    | Warehouse  | Receive goods from supplier             | Stock updated          |
| 2    | Teller     | Process 5 sales (mix member/non-member) | Sales recorded         |
| 3    | Teller     | Check low stock alerts                  | Alerts shown           |
| 4    | Manager    | View daily sales report                 | Accurate data          |
| 5    | Accountant | Verify GL entries                       | Revenue + COGS correct |

**Success Criteria:**

- [ ] Stock movements accurate
- [ ] Member pricing applied correctly
- [ ] Daily sales total correct
- [ ] Inventory balance correct
- [ ] GL balanced

---

### UAT-004: Month-End Closing

**Scenario:** Complete month-end closing process

**Actors:** Accountant, Manager

**Steps:**

| Step | Actor      | Action                        | Expected           |
| ---- | ---------- | ----------------------------- | ------------------ |
| 1    | Accountant | Run interest calculation      | Interest posted    |
| 2    | Accountant | Create adjustment journals    | Adjustments posted |
| 3    | Accountant | Generate trial balance        | Balance verified   |
| 4    | Accountant | Generate financial statements | Statements ready   |
| 5    | Manager    | Review statements             | Approved           |
| 6    | Accountant | Close period                  | Period locked      |

**Success Criteria:**

- [ ] All interest calculated and posted
- [ ] Trial balance balanced
- [ ] Financial statements accurate
- [ ] Period closed successfully
- [ ] New transactions go to new period

---

## 11. Test Data

### 11.1 User Accounts

| Email                      | Password      | Role            | Branch |
| -------------------------- | ------------- | --------------- | ------ |
| admin@koperasi.com         | Admin123!     | Super Admin     | HQ     |
| manager@koperasi.com       | Manager123!   | Manager         | HQ     |
| teller1@koperasi.com       | Teller123!    | Teller          | HQ     |
| teller2@koperasi.com       | Teller123!    | Teller          | HQ     |
| loanofficer@koperasi.com   | Loan123!      | Loan Officer    | HQ     |
| accountant@koperasi.com    | Account123!   | Accountant      | HQ     |
| warehouse@koperasi.com     | Warehouse123! | Warehouse Staff | HQ     |
| memberservice@koperasi.com | Member123!    | Member Services | HQ     |
| auditor@koperasi.com       | Auditor123!   | Auditor         | HQ     |

### 11.2 Member Test Data

| NIK              | Name         | Type    | Status   | Simpanan Pokok | Simpanan Wajib |
| ---------------- | ------------ | ------- | -------- | -------------- | -------------- |
| 3275010101800001 | Ahmad Wijaya | Regular | Active   | 500.000        | 100.000        |
| 3275010202850002 | Siti Aminah  | Regular | Active   | 500.000        | 100.000        |
| 3275010303900003 | Budi Santoso | Regular | Active   | 500.000        | 100.000        |
| 3275010404950004 | Dewi Lestari | Regular | Pending  | -              | -              |
| 3275010505000005 | Eko Prasetyo | Regular | Inactive | 500.000        | 100.000        |

### 11.3 Product Test Data

| SKU     | Name              | Category | Cost   | Sell Price | Member Price | Stock |
| ------- | ----------------- | -------- | ------ | ---------- | ------------ | ----- |
| BRS-001 | Beras 5kg         | Sembako  | 65.000 | 75.000     | 72.000       | 100   |
| MNY-001 | Minyak Goreng 2L  | Sembako  | 28.000 | 35.000     | 33.000       | 50    |
| GLA-001 | Gula Pasir 1kg    | Sembako  | 12.000 | 15.000     | 14.000       | 80    |
| TEL-001 | Telur 1kg         | Sembako  | 25.000 | 28.000     | 27.000       | 30    |
| MIE-001 | Mie Instan (5pcs) | Sembako  | 10.000 | 13.000     | 12.000       | 200   |

### 11.4 Loan Test Data

| Loan No       | Member       | Product   | Principal  | Term | Status      | Outstanding |
| ------------- | ------------ | --------- | ---------- | ---- | ----------- | ----------- |
| LN-2026-00001 | Ahmad Wijaya | Produktif | 10.000.000 | 12   | Active      | 8.000.000   |
| LN-2026-00002 | Siti Aminah  | Konsumtif | 5.000.000  | 6    | Active      | 3.000.000   |
| LN-2026-00003 | Budi Santoso | Produktif | 15.000.000 | 24   | Overdue 30d | 14.000.000  |
| LN-2026-00004 | Dewi Lestari | Darurat   | 2.000.000  | 3    | Pending     | -           |

### 11.5 Chart of Accounts

| Code   | Name              | Type      | Normal |
| ------ | ----------------- | --------- | ------ |
| 1-1000 | Kas               | Asset     | Debit  |
| 1-2000 | Piutang Pinjaman  | Asset     | Debit  |
| 1-3000 | Persediaan        | Asset     | Debit  |
| 2-1000 | Simpanan Anggota  | Liability | Credit |
| 2-2000 | Hutang Usaha      | Liability | Credit |
| 3-1000 | Modal Anggota     | Equity    | Credit |
| 4-1000 | Pendapatan Bunga  | Revenue   | Credit |
| 4-2000 | Penjualan         | Revenue   | Credit |
| 5-1000 | HPP               | Expense   | Debit  |
| 5-2000 | Biaya Operasional | Expense   | Debit  |

---

## 12. Defect Tracking

### 12.1 Defect Template

```
┌─────────────────────────────────────────────────────────────┐
│                      DEFECT REPORT                          │
├─────────────────────────────────────────────────────────────┤
│ Defect ID:        DEF-XXXX                                  │
│ Title:            [Brief description]                       │
│ Module:           [Module name]                             │
│ Severity:         Critical / High / Medium / Low            │
│ Priority:         P1 / P2 / P3 / P4                         │
│ Status:           New / Open / In Progress / Fixed / Closed │
│ Reporter:         [Name]                                    │
│ Date Found:       [Date]                                    │
│ Environment:      Staging / Production                      │
├─────────────────────────────────────────────────────────────┤
│ DESCRIPTION                                                 │
│ [Detailed description of the defect]                        │
├─────────────────────────────────────────────────────────────┤
│ STEPS TO REPRODUCE                                          │
│ 1. [Step 1]                                                 │
│ 2. [Step 2]                                                 │
│ 3. [Step 3]                                                 │
├─────────────────────────────────────────────────────────────┤
│ EXPECTED RESULT                                             │
│ [What should happen]                                        │
├─────────────────────────────────────────────────────────────┤
│ ACTUAL RESULT                                               │
│ [What actually happened]                                    │
├─────────────────────────────────────────────────────────────┤
│ ATTACHMENTS                                                 │
│ [Screenshots, logs, etc.]                                   │
├─────────────────────────────────────────────────────────────┤
│ RESOLUTION                                                  │
│ Assigned To:      [Developer name]                          │
│ Fixed In:         [Version/Build]                           │
│ Resolution Notes: [How it was fixed]                        │
│ Verified By:      [QA name]                                 │
│ Closed Date:      [Date]                                    │
└─────────────────────────────────────────────────────────────┘
```

### 12.2 Severity Definitions

| Severity     | Definition                                 | Example                                          |
| ------------ | ------------------------------------------ | ------------------------------------------------ |
| **Critical** | System unusable, data loss, security issue | Cannot login, transactions fail, data corruption |
| **High**     | Major function not working, no workaround  | Cannot process deposits, loans not disbursing    |
| **Medium**   | Function impaired but workaround exists    | Report export fails, must use alternative method |
| **Low**      | Minor issue, cosmetic, typo                | UI alignment, spelling error                     |

### 12.3 Defect Metrics

| Metric         | Formula                      | Target |
| -------------- | ---------------------------- | ------ |
| Defect Density | Defects / KLOC               | < 5    |
| Fix Rate       | Fixed / Total                | > 90%  |
| Reopen Rate    | Reopened / Fixed             | < 5%   |
| Critical Open  | Count (Critical + Open)      | 0      |
| Test Coverage  | Covered / Total Requirements | > 95%  |

---

## Riwayat Revisi

| Version | Date       | Author   | Changes                       |
| ------- | ---------- | -------- | ----------------------------- |
| 1.0     | 2026-02-03 | [Author] | Initial testing documentation |

---

_Akhir Dokumentasi Pengujian_
