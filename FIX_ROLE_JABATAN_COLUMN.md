# Fix Kolom Role Jabatan di Manajemen User

## ✅ Perubahan yang Dilakukan

### 1. **Menambahkan Relasi `roleJabatan()` di Model User**
**File:** `app/Models/User.php`

```php
public function roleJabatan()
{
    return $this->belongsTo(RoleJabatan::class, 'role_jabatan', 'id_role_jabatan');
}
```

**Fungsi:** Relasi untuk mengambil data dari tabel `role_jabatan` berdasarkan kolom `role_jabatan` di tabel `users`.

---

### 2. **Update Controller untuk Load Relasi**
**File:** `app/Http/Controllers/UserManagementController.php`

**Perubahan:**
- Line 20: `->with(['direktorat', 'departemen', 'unit', 'seksi', 'roleJabatan'])`
- Line 98: Load `roleJabatan` saat store user
- Line 158: Load `roleJabatan` saat update user

**Fungsi:** Memastikan relasi `roleJabatan` ter-load saat mengambil data user.

---

### 3. **Update JavaScript untuk Menampilkan Role Jabatan**
**File:** `resources/views/admin/users/index.blade.php`

**Logic Baru:**
```javascript
// Get role_jabatan name from relasi atau masterData
let roleJabatanName = '-';
if (user.role_jabatan_relasi && user.role_jabatan_relasi.nama_role_jabatan) {
    // Dari relasi (key 'role_jabatan_relasi' dari backend)
    roleJabatanName = user.role_jabatan_relasi.nama_role_jabatan;
} else if (user.role_jabatan) {
    // Fallback: cari di masterData berdasarkan ID
    const roleJabatanObj = masterData.roleJabatans.find(r => r.id_role_jabatan == user.role_jabatan);
    roleJabatanName = roleJabatanObj ? roleJabatanObj.nama_role_jabatan : '-';
}
```

**Fungsi:** 
1. Coba ambil dari relasi `role_jabatan_relasi` (jika ada)
2. Fallback: cari di `masterData.roleJabatans` berdasarkan ID

---

## 🔍 Masalah yang Diperbaiki

### Sebelum:
- Kolom "Role Jabatan" menampilkan nama **Direktorat** (Operation Directorate, President Directorate, dll)
- Data salah karena mengambil dari relasi yang salah

### Sesudah:
- Kolom "Role Jabatan" menampilkan nama dari tabel `role_jabatan`:
  - Director
  - General Manager
  - Senior Manager
  - Manager
  - Supervisor
  - Associate

---

## 📊 Mapping Tabel

### Tabel `users`
```
- id_user
- username
- role_jabatan (FK ke role_jabatan.id_role_jabatan)
- id_direktorat (FK ke direktorat.id_direktorat)
```

### Tabel `role_jabatan`
```
- id_role_jabatan (PK)
- nama_role_jabatan (Director, General Manager, dll)
- level
```

### Relasi
```
User::roleJabatan() -> RoleJabatan
  users.role_jabatan = role_jabatan.id_role_jabatan
```

---

## ✅ Testing

1. Refresh halaman Manajemen User
2. Lihat kolom "Role Jabatan"
3. Seharusnya menampilkan:
   - Director
   - General Manager
   - Senior Manager
   - Manager
   - Supervisor
   - Associate
4. Bukan lagi:
   - Operation Directorate
   - President Directorate
   - dll (nama direktorat)

---

## 📝 Catatan

Jika kolom masih menampilkan data yang salah, kemungkinan:
1. Cache browser - tekan Ctrl+F5 untuk hard refresh
2. Data `role_jabatan` di database NULL - cek dengan query:
   ```sql
   SELECT id_user, username, role_jabatan FROM users WHERE role_jabatan IS NULL;
   ```
