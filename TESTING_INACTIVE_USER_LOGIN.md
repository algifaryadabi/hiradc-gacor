# Inactive User Login Validation - Test Guide

## Summary
Implemented login validation to prevent inactive users from accessing the system. When a user with `user_aktif = 2` tries to login, they will see error message: **"Akun Anda dinonaktifkan. Silakan hubungi administrator."**

## How It Works

### 1. Database Field
- `users.user_aktif` column stores user status:
  - `1` = user aktif (can login)
  - `2` = user tidak aktif (cannot login)

### 2. Logic Flow

**AuthController.php** (Line 46-49):
```php
// Check if user is active
if (!$user->isActive()) {
    return back()->with('error', 'Akun Anda dinonaktifkan. Silakan hubungi administrator.');
}
```

**User Model** - `isActive()` method (Line 108):
```php
public function isActive(): bool
{
    return $this->user_aktif == 1 || $this->user_aktif === 'aktif' || $this->user_aktif === true;
}
```

### 3. Login Process Flow

1. User enters email & password
2. System finds user by email  
3. **✅ Check if user is active** (NEW)
   - If `user_aktif = 2` → **REJECT** with error message
   - If `user_aktif = 1` → Continue to password verification
4. Verify password
5. Login successful → Redirect to dashboard

---

## Testing Instructions

### Test Case 1: Active User Login ✅
1. Set user in database: `user_aktif = 1`
2. Try to login with email & password
3. **Expected**: Login successful, redirect to dashboard

### Test Case 2: Inactive User Login ❌
1. Set user in database: `user_aktif = 2`
2. Try to login with email & password
3. **Expected**: Login REJECTED, error message displays:
   ```
   Akun Anda dinonaktifkan. Silakan hubungi administrator.
   ```

### Test Case 3: User Deactivation
1. Login as admin
2. Go to User Management (`/admin/users`)
3. Edit a user → Set `user_aktif = 2`
4. Logout
5. Try to login as that user
6. **Expected**: Cannot login, sees deactivation message

---

## Admin Actions

### How to Activate/Deactivate User

**Via Admin Panel:**
1. Login as admin
2. Navigate to **User Management** (`/admin/users`)
3. Click edit on target user
4. Change "Status Aktif" field:
   - Select "Aktif" → `user_aktif = 1`
   - Select "Tidak Aktif" → `user_aktif = 2`
5. Save changes

**Via Database (Manual):**
```sql
-- Deactivate user
UPDATE users SET user_aktif = 2 WHERE id_user = <user_id>;

-- Activate user
UPDATE users SET user_aktif = 1 WHERE id_user = <user_id>;
```

---

## Files Modified

1. **AuthController.php** (Line 48)
   - Updated error message from "Akun Anda tidak aktif" to "Akun Anda dinonaktifkan"
   - More explicit message for better UX

---

## Notes

> [!IMPORTANT]
> This validation already existed in the codebase. We only updated the error message to be more user-friendly and explicit about account deactivation.

**Security Benefits:**
- Prevents compromised/terminated accounts from accessing system
- Allows instant account suspension without deleting user records
- Admin can temporarily disable access while investigating issues
