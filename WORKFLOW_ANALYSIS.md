# Analisis Sistem Approval Workflow Role Jabatan 4-6

## Status Saat Ini

### ✅ Yang Sudah Ada dan Berfungsi:

1. **3-Level Approval Workflow**
   - Level 1: Kepala Unit (`role_jabatan` = 3, `id_role_user` = 2)
   - Level 2: Unit Pengelola (category-based routing)
   - Level 3: Kepala Departemen (`role_jabatan` = 2, `id_role_user` = 2)

2. **Category-Based Routing (Level 2)**
   Di file `Document.php` line 152-175:
   - K3, KO, Lingkungan → Unit dengan nama mengandung "SHE", "SAFETY", atau "LINGKUNGAN"
   - Keamanan → Unit dengan nama mengandung "KEAMANAN" atau "SECURITY"

3. **Form Submission**
   - Semua user (termasuk role_jabatan 4-6) bisa akses `/documents/create`
   - Method `submitForApproval()` sudah mengeset `status = 'pending_level1'` dan `current_level = 1`

4. **Dashboard Views**
   - `approver/dashboard.blade.php` - Untuk Kepala Unit
   - `unit_pengelola/dashboard.blade.php` - Untuk Unit Pengelola
   - `kepala_departemen/dashboard.blade.php` - Untuk Kepala Departemen

### 🔍 Yang Perlu Diverifikasi:

1. **User Mapping**
   - User dengan `role_jabatan` 4-6 saat ini diperlakukan sebagai role "user"
   - Mereka akan diarahkan ke `user.dashboard`
   - Mereka **bisa** submit documents yang akan masuk ke approval workflow

2. **Data di Database**
   - Perlu cek apakah ada user dengan `role_jabatan` 4, 5, atau 6 di database
   - Perlu cek nama unit untuk SHE dan Keamanan

## Pertanyaan untuk User:

1. **Apakah sudah ada user dengan `role_jabatan` 4-6 di database?**
   - Jika belum, saya bisa buatkan data dummy untuk testing

2. **Apa yang Anda inginkan saya lakukan:**
   - Option A: **Verifikasi dan Dokumentasi** - Saya test sistem yang ada, pastikan berjalan untuk role_jabatan 4-6, dan buat dokumentasi
   - Option B: **Implementasi Tambahan** - Ada fitur spesifik yang perlu ditambahkan?

3. **Dashboard untuk role_jabatan 4-6:**
   - Saat ini mereka akan menggunakan `user.dashboard`
   - Apakah ini sudah sesuai atau perlu dashboard khusus?

4. **Nama role_jabatan 4-6:**
   - Untuk memahami konteks lebih baik, jabatan apa ini? (Staff, Officer, Supervisor, dll)

## Rencana Selanjutnya:

Setelah mendapat jawaban, saya akan:
1. ✅ Verifikasi data di database
2. ✅ Test complete approval flow dengan user role_jabatan 4-6
3. ✅ Buat dokumentasi step-by-step
4. ✅ Fix jika ada yang tidak berfungsi
