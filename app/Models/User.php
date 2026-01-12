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

    /**
     * Get role name from numeric role_user
     */
    public function getRoleName(): string
    {
        // Check id_role_user first (as requested)
        $roleId = $this->id_role_user ?? $this->role_user;

        // Check id_role_jabatan or role_jabatan
        $roleJabatan = $this->id_role_jabatan ?? $this->role_jabatan;

        // Custom Role Logic based on Role Jabatan
        if ($roleId == 2) { // Assuming base role is User
            if ($roleJabatan == 2) {
                return 'kepala_departemen';
            }
            if ($roleJabatan == 3) {
                return 'approver';
            }
        }

        // Handle numeric role values
        if (is_numeric($roleId)) {
            return match ((int) $roleId) {
                1 => 'admin',
                2 => 'user',
                3 => 'approver', // Explicit approver role if exists
                4 => 'unit_pengelola',
                5 => 'kepala_departemen',
                default => 'user',
            };
        }
        return $this->role_user ?? 'user';
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
        return $this->roleJabatan->nama_role_jabatan ?? '-';
    }

    /**
     * Get direktorat name
     */
    public function getDirektoratNameAttribute(): string
    {
        return $this->direktorat->nama_direktorat ?? '-';
    }

    /**
     * Get departemen name
     */
    public function getDepartemenNameAttribute(): string
    {
        return $this->departemen->nama_dept ?? '-';
    }

    /**
     * Get unit name
     */
    public function getUnitNameAttribute(): string
    {
        return $this->unit->nama_unit ?? '-';
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
        return '-';
    }
}
