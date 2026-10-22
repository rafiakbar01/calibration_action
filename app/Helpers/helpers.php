<?php

use App\Helpers\RoleHelper;

if (!function_exists('can')) {
    /**
     * Cek apakah user memiliki role yang diizinkan
     * 
     * @param string|array $roles
     * @return bool
     */
    function can($roles)
    {
        return RoleHelper::hasRole($roles);
    }
}

if (!function_exists('canOrFail')) {
    /**
     * Cek role dan lempar 403 jika tidak diizinkan
     * 
     * @param string|array $roles
     * @param string|null $message
     * @return void
     */
    function canOrFail($roles, $message = null)
    {
        return RoleHelper::allowOrFail($roles, $message);
    }
}

if (!function_exists('canFeature')) {
    /**
     * Cek role berdasarkan fitur
     * 
     * @param string $feature
     * @return void
     */
    function canFeature($feature)
    {
        return RoleHelper::allowFeatureOrFail($feature);
    }
}

if (!function_exists('isRole')) {
    /**
     * Cek apakah user memiliki role tertentu
     * 
     * @param string $role
     * @return bool
     */
    function isRole($role)
    {
        if (!auth()->check()) {
            return false;
        }
        return auth()->user()->role === $role;
    }
}

if (!function_exists('isSuperAdmin')) {
    /**
     * Cek apakah user adalah super admin
     * 
     * @return bool
     */
    function isSuperAdmin()
    {
        return isRole('super admin');
    }
}

if (!function_exists('isTeknisi')) {
    /**
     * Cek apakah user adalah teknisi
     * 
     * @return bool
     */
    function isTeknisi()
    {
        return isRole('teknisi');
    }
}

if (!function_exists('isApprover')) {
    /**
     * Cek apakah user adalah approver
     * 
     * @return bool
     */
    function isApprover()
    {
        return isRole('approver');
    }
}

if (!function_exists('isChecker')) {
    /**
     * Cek apakah user adalah checker
     * 
     * @return bool
     */
    function isChecker()
    {
        return isRole('checker');
    }
}

if (!function_exists('userRole')) {
    /**
     * Dapatkan role user saat ini
     * 
     * @return string|null
     */
    function userRole()
    {
        return auth()->check() ? auth()->user()->role : null;
    }
}

if (!function_exists('userName')) {
    /**
     * Dapatkan nama user saat ini
     * 
     * @return string|null
     */
    function userName()
    {
        return auth()->check() ? auth()->user()->nama : null;
    }
}

if (!function_exists('userNik')) {
    /**
     * Dapatkan NIK user saat ini
     * 
     * @return string|null
     */
    function userNik()
    {
        return auth()->check() ? auth()->user()->nik : null;
    }
}

if (!function_exists('formatRole')) {
    /**
     * Format role menjadi huruf kapital di awal atau PPIC
     * 
     * @param string|null $role
     * @return string
     */
    function formatRole($role = null)
    {
        $role = $role ?? userRole();
        if (!$role) return '-';
        if (strtolower($role) === 'ppic') return 'PPIC';
        return ucwords($role);
    }
}

if (!function_exists('getAllowedRolesForFeature')) {
    /**
     * Dapatkan daftar role yang diizinkan untuk fitur
     * 
     * @param string $feature
     * @return array
     */
    function getAllowedRolesForFeature($feature)
    {
        return RoleHelper::getAllowedRoles($feature);
    }
}

if (!function_exists('roleBadge')) {
    /**
     * Buat badge HTML untuk role
     * 
     * @param string|null $role
     * @return string
     */
    function roleBadge($role = null)
    {
        $role = $role ?? userRole();
        
        $colors = [
            'super admin' => 'danger',
            'teknisi'     => 'info',
            'approver'    => 'success',
            'checker'     => 'warning',
            'ppic'        => 'primary',
            'user'        => 'secondary'
        ];
        
        $color = $colors[$role] ?? 'secondary';
        $formattedRole = formatRole($role);
        
        return "<span class=\"badge badge-{$color}\">{$formattedRole}</span>";
    }
}


if (!function_exists('canAccess')) {
    /**
     * Cek akses untuk multiple kondisi
     * 
     * @param array $conditions
     * @return bool
     */
    function canAccess(array $conditions)
    {
        foreach ($conditions as $type => $value) {
            switch ($type) {
                case 'role':
                    if (!can($value)) return false;
                    break;
                case 'not_role':
                    if (can($value)) return false;
                    break;
                case 'auth':
                    if (!auth()->check()) return false;
                    break;
                case 'guest':
                    if (auth()->check()) return false;
                    break;
                case 'permission':
                    // Untuk permission nanti jika ada
                    break;
            }
        }
        return true;
    }
}

if (!function_exists('isPpic')) {
    /**
     * Cek apakah user adalah PPIC
     * 
     * @return bool
     */
    function isPpic()
    {
        return isRole('ppic');
    }
}


if (!function_exists('canAccessDashboardControl')) {
    /**
     * Cek apakah user berhak mengakses Dashboard Control
     * (Super Admin, Checker, Approver, ATAU NIK PAS-069)
     * 
     * @return bool
     */
    function canAccessDashboardControl()
    {
        if (!auth()->check()) {
            return false;
        }
        
        // Berikan akses khusus untuk NIK PAS-069
        if (auth()->user()->nik === 'PAS-069') {
            return true;
        }
        
         if (isSuperAdmin() || isChecker() || isApprover() || isPpic()) {
            return true;
        }
        
        return false;
    }
}