# Quick Reference - Approval Workflow

## 🔑 Role Mapping

| Role Jabatan | Level | Role Name | Dashboard Route | Tugas |
|--------------|-------|-----------|-----------------|-------|
| 3 | Level 1 | `approver` | `approver.dashboard` | Kepala Unit (approval pertama di unit sendiri) |
| 3 (unit 55/56) | Level 2 | `unit_pengelola` | `unit_pengelola.dashboard` | Kepala Unit SHE/Security (approval kedua) |
| 2 | Level 3 | `kepala_departemen` | `kepala_departemen.dashboard` | Kepala Departemen (approval final) |

## 📋 Level 2 - Unit Pengelola Rules

### Kepala Unit SHE (unit_id = 56)
- **Role**: `role_jabatan = 3`
- **Review**: Dokumen kategori **K3, KO, Lingkungan**
- **Tidak bisa**: Review dokumen Keamanan

### Kepala Unit Security (unit_id = 55)
- **Role**: `role_jabatan = 3`
- **Review**: Dokumen kategori **Keamanan**
- **Tidak bisa**: Review dokumen K3/KO/Lingkungan

## 🔄 Workflow

```
User Submit → Level 1 (Kepala Unit sama unit) 
           → Level 2 (Kepala Unit SHE/Security berdasarkan kategori)
           → Level 3 (Kepala Departemen sama dept)
           → Approved
```

## 🧪 Testing Quick Commands

### 1. Update User untuk Testing
```sql
-- Jadikan Kepala Unit Security
UPDATE users SET role_jabatan=3, id_unit=55 WHERE id_user=11;

-- Jadikan Kepala Unit SHE
UPDATE users SET role_jabatan=3, id_unit=56 WHERE id_user=18;

-- Cek hasilnya
SELECT id_user, nama_user, role_jabatan, id_unit FROM users WHERE id_user IN (11,18);
```

### 2. Cek Pending Documents Level 2
```sql
SELECT id, kategori, status, current_level, id_unit 
FROM documents 
WHERE current_level=2 AND status='pending_level2';
```

### 3. Cek Hierarki Unit-Department
```sql
SELECT u.id_unit, u.nama_unit, u.id_dept, d.nama_dept
FROM unit u
LEFT JOIN departemen d ON u.id_dept = d.id_dept
WHERE u.id_unit IN (55, 56);
```

## 🐛 Troubleshooting

### User tidak bisa akses dashboard Unit Pengelola
**Cek**:
- `role_jabatan` harus = 3
- `id_unit` harus 55 atau 56

### Dokumen tidak muncul di dashboard
**Cek**:
- Kategori dokumen vs unit user
- Status dokumen = `pending_level2`
- `current_level` = 2

### 403 Forbidden
**Penyebab**: User bukan Kepala Unit dari unit yang benar
**Fix**: Update `role_jabatan` dan `id_unit`

## 📞 Contact Info

Files yang diubah:
- `app/Models/Document.php` (Line 156-179)
- `app/Http/Controllers/DocumentController.php` (Line 189-194, 258-298)
- `routes/web.php` (Line 114-139)
- `app/Models/User.php` (Line 98-135)
