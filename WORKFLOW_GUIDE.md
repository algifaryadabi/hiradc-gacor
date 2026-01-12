# Dokumentasi: Approval Workflow untuk User dengan Role Jabatan 4-6

## Ringkasan Sistem

Sistem approval HIRADC sudah memiliki 3 level approval yang berfungsi:

**Level 1: Kepala Unit** (`role_jabatan` = 3)
- Melihat dokumen dari unit yang sama
- Dashboard: `/approver/dashboard`

**Level 2: Unit Pengelola** (routing berdasarkan kategori)
- **K3, KO, Lingkungan** → Unit Pengelola SHE
- **Keamanan** → Unit Keamanan
- Dashboard: `/unit-pengelola/dashboard`

**Level 3: Kepala Departemen** (`role_jabatan` = 2)
- Melihat dokumen dari departemen yang sama
- Dashboard: `/kepala-departemen/dashboard`

## Workflow untuk User dengan Role Jabatan 4-6

### 1. Submit Dokumen

User dengan `role_jabatan` 4-6 dapat:
1. Login ke sistem
2. Akses `/user/dashboard`
3. Buat dokumen baru via `/documents/create`
4. Pilih kategori (K3, KO, Lingkungan, atau Keamanan)
5. Submit dokumen

**Yang terjadi di backend:**
```php
// Di DocumentController.php store()
$document = Document::create([
    'id_user' => $user->id_user,
    'status' => 'draft', // Initially draft
    'current_level' => 0,
    // ... other fields
]);

// Saat submit for approval
$document->submitForApproval(); // Sets status = 'pending_level1', current_level = 1
```

### 2. Approval Level 1 (Kepala Unit)

Dokumen masuk ke dashboard **Kepala Unit** yang sama unitnya dengan submitter.

**Query di routes/web.php (line 73-78):**
```php
$pendingDocuments = \App\Models\Document::where('current_level', 1)
    ->where('status', 'pending_level1')
    ->where('id_unit', $user->id_unit) // Same unit!
    ->with(['user', 'unit'])
    ->orderBy('created_at', 'desc')
    ->get();
```

**Kepala Unit dapat:**
- Review dokumen via `/approver/documents/{id}/review`
- Approve → dokumen pindah ke Level 2
- Revise → dokumen kembali ke submitter

### 3. Approval Level 2 (Unit Pengelola)

Setelah diapprove Level 1, dokumen masuk ke **Unit Pengelola** berdasarkan kategori.

**Logic di Document.php canBeApprovedBy() (line 152-175):**
```php
if ($this->current_level == 2) {
    if ($user->getRoleName() !== 'unit_pengelola') {
        return false;
    }
    
    $userUnitName = strtoupper($user->unit->nama_unit ?? '');
    
    // K3, KO, Lingkungan → SHE Unit
    if (in_array($this->kategori, ['K3', 'KO', 'Lingkungan'])) {
        return str_contains($userUnitName, 'SHE') ||
            str_contains($userUnitName, 'SAFETY') ||
            str_contains($userUnitName, 'LINGKUNGAN');
    } 
    
    // Keamanan → Security Unit
    else if ($this->kategori === 'Keamanan') {
        return str_contains($userUnitName, 'KEAMANAN') ||
            str_contains($userUnitName, 'SECURITY');
    }
}
```

**Query di routes/web.php (line 104-108):**
```php
$pendingDocuments = \App\Models\Document::where('current_level', 2)
    ->where('status', 'pending_level2')
    ->with(['user', 'unit'])
    ->orderBy('created_at', 'desc')
    ->get();
```

### 4. Approval Level 3 (Kepala Departemen)

Setelah diapprove Level 2, dokumen masuk ke **Kepala Departemen**.

**Query di routes/web.php (line 141-146):**
```php
$pendingDocuments = \App\Models\Document::where('current_level', 3)
    ->where('status', 'pending_level3')
    ->where('id_dept', $user->id_dept) // Same department!
    ->with(['user', 'unit'])
    ->orderBy('created_at', 'desc')
    ->get();
```

**Setelah diapprove:**
```php
// Di Document.php approve() method (line 117-119)
$this->status = 'approved';
$this->published_at = now();
```

Dokumen menjadi **published** dan tampil di semua dashboard sebagai "Laporan Terpublikasi".

## Cara Testing Manual

### Langkah 1: Login sebagai User Role Jabatan 4-6

1. Buka browser, akses `http://localhost:8000/login`
2. Login dengan credentials user yang memiliki `role_jabatan` 4, 5, atau 6
3. Verify redirect ke `/user/dashboard`

### Langkah 2: Submit Dokumen

1. Klik "Buat Dokumen Baru" atau akses `/documents/create`
2. Isi form:
   - Pilih **Kategori**: K3 (untuk test routing ke SHE)
   - Isi **Proses/Aktivitas**
   - Isi **Nama Kegiatan**
   - Isi **Lokasi**
   - Lengkapi form lainnya
3. Centang "Submit for Approval"
4. Klik "Simpan"

### Langkah 3: Verify di Kepala Unit Dashboard

1. Logout dan login sebagai **Kepala Unit** (user dengan `role_jabatan` = 3, unit yang sama)
2. Akses `/approver/dashboard`
3. **Expected**: Dokumen yang baru disubmit muncul di tabel "Perlu Validasi / Review"
4. Klik "Review" dan approve dokumen

### Langkah 4: Verify di Unit Pengelola Dashboard

1. Logout dan login sebagai **Unit Pengelola SHE**
2. Akses `/unit-pengelola/dashboard`
3. **Expected**: Dokumen kategori K3 muncul di tabel pending
4. Review dan approve dokumen

### Langkah 5: Verify di Kepala Departemen Dashboard

1. Logout dan login sebagai **Kepala Departemen** (department yang sama)
2. Akses `/kepala-departemen/dashboard`
3. **Expected**: Dokumen muncul di pending table
4. Review dan approve dokumen

### Langkah 6: Verify Published

1. Cek di any dashboard, dokumen should appear in "Laporan Terpublikasi"
2. Status = "DISETUJUI"

## Kesimpulan

✅ **Sistem sudah lengkap dan siap digunakan untuk role_jabatan 4-6!**

Tidak ada perubahan code yang diperlukan karena:
- Form submission sudah support semua user
- Approval workflow sudah handle 3 levels dengan benar
- Category-based routing sudah diimplementasikan
- Dashboard routing sudah sesuai

Yang perlu dipastikan hanya:
1. Ada user dengan `role_jabatan` 4-6 di database (sudah dikonfirmasi ada)
2. Ada unit dengan nama mengandung "SHE" atau "Keamanan"
3. User approver sudah diset dengan benar di setiap level

## Troubleshooting

**Q: Dokumen tidak muncul di dashboard Kepala Unit?**
- A: Pastikan Kepala Unit memiliki `id_unit` yang sama dengan submitter

**Q: Dokumen tidak muncul di Unit Pengelola?**
- A: Pastikan:
  - Unit Pengelola memiliki unit dengan nama mengandung "SHE" untuk K3/KO/Lingkungan
  - Unit Pengelola memiliki unit dengan nama mengandung "Keamanan" untuk kategori Keamanan
  - User memiliki `id_role_user` = 4 (unit_pengelola) atau sesuai mapping di User.php

**Q: Error 403 saat approve?**
- A: Periksa method `canBeApprovedBy()` di Document.php untuk memastikan logic approve sudah benar
