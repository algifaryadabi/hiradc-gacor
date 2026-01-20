# Debug & Fix: Kolom Role Jabatan Menampilkan "-"

## 🔍 Masalah
Kolom "Role Jabatan" di halaman Manajemen User menampilkan tanda "-" padahal seharusnya menampilkan nama role jabatan dari tabel `role_jabatan`.

## 🛠️ Langkah Debug

### 1. Cek Console Browser
1. Buka halaman Manajemen User
2. Tekan F12 untuk buka Developer Tools
3. Lihat tab Console
4. Cari log: "Sample User data:"
5. Perhatikan struktur `role_jabatan`:
   - Jika **object** → relasi ter-load ✅
   - Jika **number** → hanya ID, relasi tidak ter-load ❌
   - Jika **null** → data tidak ada di database

### 2. Cek Database
```sql
-- Cek apakah user punya role_jabatan
SELECT id_user, username, role_jabatan FROM users LIMIT 10;

-- Cek apakah tabel role_jabatan ada data
SELECT * FROM role_jabatan;

-- Cek relasi
SELECT 
    u.id_user,
    u.username,
    u.role_jabatan,
    rj.nama_role_jabatan
FROM users u
LEFT JOIN role_jabatan rj ON u.role_jabatan = rj.id_role_jabatan
LIMIT 10;
```

### 3. Kemungkinan Penyebab

#### A. Data `role_jabatan` NULL di tabel users
**Solusi:**
```sql
-- Update user yang belum punya role_jabatan
UPDATE users SET role_jabatan = 6 WHERE role_jabatan IS NULL;
-- 6 = Associate (default)
```

#### B. Relasi tidak ter-load dari backend
**Cek di Controller:**
```php
// File: app/Http/Controllers/UserManagementController.php
// Line 20: harus ada 'roleJabatan'
$users = User::with(['direktorat', 'departemen', 'unit', 'seksi', 'roleJabatan'])->paginate(10);
```

#### C. Nama relasi salah di JavaScript
**Cek struktur JSON dari console:**
```javascript
// Jika relasi ter-load, strukturnya:
{
  id_user: 1,
  username: "test",
  role_jabatan: {  // ← Object, bukan number
    id_role_jabatan: 3,
    nama_role_jabatan: "Senior Manager"
  }
}

// Jika relasi TIDAK ter-load:
{
  id_user: 1,
  username: "test",
  role_jabatan: 3  // ← Number (ID saja)
}
```

---

## ✅ Solusi yang Sudah Diterapkan

### 1. Relasi di Model User
```php
public function roleJabatan()
{
    return $this->belongsTo(RoleJabatan::class, 'role_jabatan', 'id_role_jabatan');
}
```

### 2. Load Relasi di Controller
```php
$users = User::with(['direktorat', 'departemen', 'unit', 'seksi', 'roleJabatan'])->paginate(10);
```

### 3. JavaScript Logic
```javascript
// Cek apakah ada relasi role_jabatan yang ter-load
if (user.role_jabatan && typeof user.role_jabatan === 'object' && user.role_jabatan.nama_role_jabatan) {
    // Relasi ter-load sebagai object
    roleJabatanName = user.role_jabatan.nama_role_jabatan;
} else if (user.role_jabatan && typeof user.role_jabatan === 'number') {
    // role_jabatan adalah ID, cari di masterData
    const roleJabatanObj = masterData.roleJabatans.find(r => r.id_role_jabatan == user.role_jabatan);
    roleJabatanName = roleJabatanObj ? roleJabatanObj.nama_role_jabatan : '-';
}
```

---

## 🧪 Testing

### Test 1: Cek Console Log
1. Refresh halaman (Ctrl+F5)
2. Buka Console (F12)
3. Lihat output "Sample User data:"
4. Screenshot dan share jika masih error

### Test 2: Cek Database
```sql
-- Pastikan ada data role_jabatan
SELECT COUNT(*) FROM role_jabatan;
-- Harus > 0

-- Pastikan user punya role_jabatan
SELECT COUNT(*) FROM users WHERE role_jabatan IS NOT NULL;
-- Harus > 0
```

### Test 3: Test Manual
1. Edit user di halaman admin
2. Pilih Role Jabatan dari dropdown
3. Save
4. Refresh halaman
5. Cek apakah Role Jabatan muncul

---

## 📋 Checklist Debug

- [ ] Console log menampilkan struktur user
- [ ] `role_jabatan` adalah object (bukan number)
- [ ] Database punya data di tabel `role_jabatan`
- [ ] User punya `role_jabatan` yang tidak NULL
- [ ] Controller load relasi `roleJabatan`
- [ ] JavaScript bisa baca `user.role_jabatan.nama_role_jabatan`

---

## 💡 Quick Fix

Jika masih menampilkan "-", coba:

1. **Hard refresh browser:** Ctrl+Shift+R
2. **Clear cache:** Ctrl+Shift+Delete
3. **Update data manual:**
   ```sql
   UPDATE users SET role_jabatan = 6 WHERE role_jabatan IS NULL;
   ```
4. **Restart Laravel:** `php artisan config:clear`
