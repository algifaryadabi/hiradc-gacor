<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'username',
        'nama_user',
        'email_user',
        'password',
        'id_direktorat',
        'id_dept',
        'id_unit',
        'id_seksi',
        'role_jabatan',
        'id_role_jabatan', // Added as fallback
        'foto_user',
        'role_user',
        'id_role_user',
        'user_aktif',
    ];

    protected $hidden = [
        'password',
    ];

    // ==================== RELATIONSHIPS ====================

    /**
     * Get the role jabatan for the user
     */
    public function roleJabatan()
    {
        // Try both possible keys
        return $this->belongsTo(RoleJabatan::class, 'role_jabatan', 'id_role_jabatan');
    }

    /**
     * Get the direktorat for the user
     */
    public function direktorat()
    {
        return $this->belongsTo(Direktorat::class, 'id_direktorat', 'id_direktorat');
    }

    /**
     * Get the departemen for the user
     */
    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'id_dept', 'id_dept');
    }

    /**
     * Get the unit for the user
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id_unit', 'id_unit');
    }

    // ==================== HELPER METHODS ====================

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function hasRole(string $role): bool
    {
        return $this->role_user === $role || $this->getRoleName() === $role;
    }

    public function isAdmin(): bool
    {
        return $this->getRoleName() === 'admin';
    }

    public function isActive(): bool
    {
        return $this->user_aktif == 1 || $this->user_aktif === 'aktif' || $this->user_aktif === true;
    }

    // ==================== ROLE CHECKERS ====================

    public function isKepalaDepartemen(): bool
    {
        return $this->id_role_jabatan == 2 || $this->role_jabatan == 2;
    }

    public function isKepalaUnit(): bool
    {
        return $this->id_role_jabatan == 3 || $this->role_jabatan == 3;
    }

    public function isKepalaSeksi(): bool
    {
        return $this->id_role_jabatan == 4 || $this->role_jabatan == 4;
    }

    /**
     * Get role name based on hierarchy
     */
    public function getRoleName(): string
    {
        // 1. Check for Unit Pengelola (Special Case for Level 2 Approver)
        // Must be Kepala Unit (Role 3) AND from specific units
        if ($this->isKepalaUnit()) {
            if (in_array($this->id_unit, [55, 56])) { // 55=Security, 56=SHE
                return 'unit_pengelola';
            }
            return 'approver'; // Standard Kepala Unit
        }

        // 2. Kepala Departemen
        if ($this->isKepalaDepartemen()) {
            return 'kepala_departemen';
        }

        // 3. User (Role 4, 5, 6)
        // Role 4 (Manager) could be Kepala Seksi, but they act as Users in this workflow unless we add Level 0
        if (in_array($this->role_jabatan ?? $this->id_role_jabatan, [4, 5, 6])) {
            return 'user';
        }

        // 4. Admin
        if (($this->role_user ?? $this->id_role_user) == 1) {
            return 'admin';
        }

        return 'user';
    }

    public function getDashboardRoute(): string
    {
        $role = $this->getRoleName();

        return match ($role) {
            'admin' => 'admin.dashboard',
            'approver' => 'approver.dashboard',
            'unit_pengelola' => 'unit_pengelola.dashboard',
            'kepala_departemen' => 'kepala_departemen.dashboard',
            default => 'user.dashboard',
        };
    }


    public function getDisplayNameAttribute(): string
    {
        return $this->nama_user ?? $this->username;
    }

    /**
     * Get role jabatan name
     */
    public function getRoleJabatanNameAttribute(): string
    {
        if ($this->roleJabatan) {
            return $this->roleJabatan->nama_role_jabatan ?? '-';
        }
        return '-';
    }

    /**
     * Get direktorat name
     */
    public function getDirektoratNameAttribute(): string
    {
        if ($this->direktorat) {
            return $this->direktorat->nama_direktorat ?? '-';
        }
        return '-';
    }

    /**
     * Get departemen name
     */
    public function getDepartemenNameAttribute(): string
    {
        if ($this->departemen) {
            return $this->departemen->nama_dept ?? '-';
        }
        return '-';
    }

    /**
     * Get unit name
     */
    public function getUnitNameAttribute(): string
    {
        if ($this->unit) {
            return $this->unit->nama_unit ?? '-';
        }
        return '-';
    }

    /**
     * Get unit or department name for sidebar display
     */
    public function getUnitOrDeptNameAttribute(): string
    {
        if ($this->unit && $this->unit->nama_unit) {
            return $this->unit->nama_unit;
        }
        if ($this->departemen && $this->departemen->nama_dept) {
            return $this->departemen->nama_dept;
        }
        if ($this->direktorat && $this->direktorat->nama_direktorat) {
            return $this->direktorat->nama_direktorat;
        }
        return 'User';
    }
}
