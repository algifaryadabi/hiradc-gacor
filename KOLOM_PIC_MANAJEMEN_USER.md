# Kolom PIC di Manajemen User

## ✅ Fitur yang Ditambahkan

Kolom **PIC (Person In Charge)** di tampilan manajemen user dengan dropdown **Ya/Tidak** untuk menandai user sebagai PIC form HIRADC.

---

## 📋 Implementasi

### 1. Header Tabel
**File:** `resources/views/admin/users/index.blade.php`

```html
<th width="6%">PIC</th>
```

Ditambahkan setelah kolom **Seksi** dan sebelum **Role Jabatan**.

---

### 2. View Mode (renderViewRow)
```javascript
<td>
    <select class="input-select" onchange="togglePIC(${user.id_user}, this.value)" 
            style="padding: 5px 10px; font-size: 13px;">
        <option value="0" ${user.can_create_documents != 1 ? 'selected' : ''}>Tidak</option>
        <option value="1" ${user.can_create_documents == 1 ? 'selected' : ''}>Ya</option>
    </select>
</td>
```

**Fungsi:**
- Dropdown otomatis ter-select berdasarkan `user.can_create_documents`
- Saat dropdown diubah, fungsi `togglePIC()` dipanggil

---

### 3. Edit Mode (renderEditRow)
```javascript
<td>
    <select class="input-select" id="e_pic_${id}">
        <option value="0" ${user.can_create_documents != 1 ? 'selected' : ''}>Tidak</option>
        <option value="1" ${user.can_create_documents == 1 ? 'selected' : ''}>Ya</option>
    </select>
</td>
```

**Fungsi:**
- Dropdown ter-select berdasarkan data user
- Admin bisa ubah status PIC saat edit user

---

### 4. Fungsi togglePIC()
```javascript
async function togglePIC(userId, newValue) {
    const user = allUsers.find(u => u.id_user == userId);
    if (!user) return;
    
    const isPIC = newValue == 1;
    const action = isPIC ? 'menandai' : 'menghapus penandaan';
    
    // SweetAlert confirmation
    const result = await Swal.fire({
        title: `${isPIC ? 'Tandai' : 'Hapus'} sebagai PIC?`,
        html: `Apakah Anda yakin ingin ${action} <strong>${user.username}</strong> sebagai PIC?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Lanjutkan',
        cancelButtonText: 'Batal'
    });
    
    if (!result.isConfirmed) {
        // Revert dropdown jika batal
        event.target.value = user.can_create_documents == 1 ? '1' : '0';
        return;
    }
    
    // Update via API
    const response = await fetch(`/admin/users/${userId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            can_create_documents: isPIC ? 1 : 0
        })
    });
    
    if (response.ok) {
        // Update local data
        user.can_create_documents = isPIC ? 1 : 0;
        Swal.fire('Berhasil!', `User ${isPIC ? 'ditandai' : 'dihapus penandaannya'} sebagai PIC`, 'success');
    }
}
```

**Fungsi:**
1. Tampilkan SweetAlert confirmation
2. Jika user klik "Batal" → revert dropdown
3. Jika user klik "Ya" → update `can_create_documents` via API
4. Update local data dan tampilkan notifikasi sukses

---

## 🎯 Cara Penggunaan

### Menandai User sebagai PIC
1. Di tabel manajemen user, cari user yang ingin ditandai
2. Klik dropdown di kolom **PIC**
3. Pilih **"Ya"**
4. Konfirmasi di SweetAlert
5. User ditandai sebagai PIC (`can_create_documents = 1`)

### Menghapus Penandaan PIC
1. Cari user yang sudah ditandai sebagai PIC
2. Klik dropdown di kolom **PIC**
3. Pilih **"Tidak"**
4. Konfirmasi di SweetAlert
5. Penandaan PIC dihapus (`can_create_documents = 0`)

---

## 📊 Mapping Database

| Kolom | Tipe | Nilai | Keterangan |
|-------|------|-------|------------|
| `can_create_documents` | TINYINT(1) | 0 | User **TIDAK** bisa buat form |
| `can_create_documents` | TINYINT(1) | 1 | User **BISA** buat form (PIC) |

---

## ✅ Testing

### Test 1: Tandai User sebagai PIC
1. Pilih user dengan PIC = "Tidak"
2. Ubah dropdown ke "Ya"
3. Klik "Ya, Lanjutkan" di SweetAlert
4. **Hasil:** User ditandai sebagai PIC, dropdown berubah ke "Ya"

### Test 2: Hapus Penandaan PIC
1. Pilih user dengan PIC = "Ya"
2. Ubah dropdown ke "Tidak"
3. Klik "Ya, Lanjutkan" di SweetAlert
4. **Hasil:** Penandaan dihapus, dropdown berubah ke "Tidak"

### Test 3: Batal Ubah PIC
1. Ubah dropdown PIC
2. Klik "Batal" di SweetAlert
3. **Hasil:** Dropdown kembali ke nilai semula

### Test 4: Edit User dengan PIC
1. Klik Edit user yang PIC = "Ya"
2. **Hasil:** Dropdown PIC di edit mode ter-select "Ya"
3. Ubah ke "Tidak" dan Simpan
4. **Hasil:** Data tersimpan, PIC berubah ke "Tidak"

---

## 📝 Catatan

**Apa itu PIC?**
- PIC = Person In Charge
- User yang ditandai sebagai PIC bisa membuat form HIRADC
- Hanya 1 PIC per unit (aturan bisnis)

**Hubungan dengan Delegasi:**
- Kolom PIC ini sama dengan sistem delegasi yang sudah ada
- `can_create_documents = 1` → User adalah delegate/PIC
- Admin bisa set PIC langsung dari halaman manajemen user
