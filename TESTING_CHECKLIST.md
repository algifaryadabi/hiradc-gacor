# Testing Checklist - Unit Pengelola Approval

## ✅ Pre-Testing Setup

### 1. Setup Test Users
```sql
-- Kepala Unit Security (untuk test dokumen Keamanan)
UPDATE users SET role_jabatan=3, id_unit=55 WHERE id_user=11;

-- Kepala Unit SHE (untuk test dokumen K3/KO/Lingkungan)
UPDATE users SET role_jabatan=3, id_unit=56 WHERE id_user=18;

-- Verifikasi
SELECT id_user, nama_user, username, role_jabatan, id_unit 
FROM users WHERE id_user IN (11, 18);
```

### 2. Create Test Documents (jika belum ada)
Pastikan ada dokumen di Level 2 dengan berbagai kategori.

---

## 📝 Test Case 1: Kepala Unit Security

### Login
- **Username**: `ABD.RAHMAN3140` (atau sesuai user id=11)
- **Password**: `semenpadang 1`

### Expected Behavior
- [x] Redirect ke dashboard `/unit-pengelola/dashboard`
- [x] Menu "Check Documents" terlihat
- [x] Hanya dokumen kategori **Keamanan** yang muncul
- [x] Tidak ada dokumen K3/KO/Lingkungan
- [x] Bisa klik "Review" pada dokumen Keamanan
- [x] Bisa approve/revise dokumen Keamanan

### Test Steps
1. Login dengan kredensial di atas
2. Perhatikan URL setelah login (harus `/unit-pengelola/dashboard`)
3. Klik "Check Documents" atau "Cek Dokumen Pending"
4. Hitung jumlah dokumen yang muncul
5. Verifikasi semua dokumen kategori = Keamanan
6. Klik "Review" pada salah satu dokumen
7. Coba approve dengan catatan
8. Verifikasi dokumen pindah ke Level 3

### Result: ⬜ PASS / ⬜ FAIL

---

## 📝 Test Case 2: Kepala Unit SHE

### Login
- **Username**: `ABRIADI` (atau sesuai user id=18)
- **Password**: `semenpadang 1`

### Expected Behavior
- [x] Redirect ke dashboard `/unit-pengelola/dashboard`
- [x] Menu "Check Documents" terlihat
- [x] Hanya dokumen kategori **K3, KO, atau Lingkungan** yang muncul
- [x] Tidak ada dokumen Keamanan
- [x] Bisa klik "Review" pada dokumen K3/KO/Lingkungan
- [x] Bisa approve/revise dokumen

### Test Steps
1. Login dengan kredensial di atas
2. Perhatikan URL setelah login (harus `/unit-pengelola/dashboard`)
3. Klik "Check Documents"
4. Hitung jumlah dokumen yang muncul
5. Verifikasi semua dokumen kategori = K3/KO/Lingkungan
6. Klik "Review" pada salah satu dokumen
7. Coba approve dengan catatan
8. Verifikasi dokumen pindah ke Level 3

### Result: ⬜ PASS / ⬜ FAIL

---

## 📝 Test Case 3: User Biasa (Negative Test)

### Login
- **Username**: Pilih user dengan `role_jabatan != 3`
- **Password**: Sesuai user

### Expected Behavior
- [x] Redirect ke dashboard user biasa `/user/dashboard`
- [x] TIDAK ada menu Unit Pengelola
- [x] Akses manual ke `/unit-pengelola/dashboard` → **403 Forbidden**

### Test Steps
1. Login dengan user biasa
2. Cek menu sidebar (tidak boleh ada menu Unit Pengelola)
3. Manual buka URL: `http://127.0.0.1:8000/unit-pengelola/dashboard`
4. Harus dapat error 403 Forbidden

### Result: ⬜ PASS / ⬜ FAIL

---

## 📝 Test Case 4: Cross-Category Access (Negative Test)

### Setup
Login sebagai Kepala Unit Security (user id=11)

### Test Steps
1. Cari dokumen K3 yang ada di Level 2
2. Copy ID dokumen (misalnya: id=3)
3. Manual akses: `http://127.0.0.1:8000/unit-pengelola/documents/3/review`

### Expected Behavior
- [x] Bisa buka halaman review
- [x] Ketika klik "Approve" → harus ditolak atau error
- [x] Atau halaman review tidak menampilkan tombol approve

### Result: ⬜ PASS / ⬜ FAIL

---

## 📝 Test Case 5: Level 3 Routing

### Setup
1. Login sebagai Kepala Unit SHE (id=18)
2. Approve sebuah dokumen K3

### Test Steps
1. Approve dokumen K3
2. Cek di database: `SELECT id, status, current_level FROM documents WHERE id=X;`
3. Status harus = `pending_level3`
4. `current_level` harus = 3
5. Cek `id_dept` dokumen
6. Login sebagai Kepala Departemen dengan `id_dept` yang sama
7. Harus bisa lihat dokumen tersebut di dashboard

### Expected Result
- [x] Dokumen pindah ke Level 3
- [x] Muncul di dashboard Kepala Departemen yang sesuai

### Result: ⬜ PASS / ⬜ FAIL

---

## 📊 Overall Test Results

| Test Case | Status | Notes |
|-----------|--------|-------|
| TC1: Kepala Unit Security | ⬜ PASS / ⬜ FAIL | |
| TC2: Kepala Unit SHE | ⬜ PASS / ⬜ FAIL | |
| TC3: User Biasa (403) | ⬜ PASS / ⬜ FAIL | |
| TC4: Cross-Category | ⬜ PASS / ⬜ FAIL | |
| TC5: Level 3 Routing | ⬜ PASS / ⬜ FAIL | |

---

## 🐛 Issues Found

| Issue | Severity | Description | Status |
|-------|----------|-------------|--------|
| | | | |

---

## ✅ Sign-off

- Tested by: ________________
- Date: ________________
- All tests passed: ⬜ YES / ⬜ NO
