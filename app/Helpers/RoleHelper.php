<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class RoleHelper
{
    /**
     * Cek apakah user memiliki role yang diizinkan
     */
    public static function hasRole($roles)
    {
        if (!Auth::check()) {
            return false;
        }

        $userRole = Auth::user()->role;
        $allowedRoles = is_array($roles) ? $roles : explode(',', $roles);

        return in_array($userRole, $allowedRoles);
    }

    /**
     * Cek role dan lempar 403 jika tidak diizinkan
     */
    public static function allowOrFail($roles, $message = null)
    {
        if (!self::hasRole($roles)) {
            $message = $message ?: 'Anda tidak memiliki izin untuk mengakses halaman ini. Role Anda: ' . Auth::user()->role;
            abort(403, $message);
        }
    }

    /**
     * Dapatkan daftar role yang diizinkan untuk fitur tertentu
     */
    public static function getAllowedRoles($feature)
    {
        $roles = [
            // Calibrations
            'calibrations.view' => ['super admin', 'teknisi', 'approver', 'checker'],
            'calibrations.create' => ['super admin', 'teknisi'],
            'calibrations.edit' => ['super admin', 'teknisi'],
            'calibrations.delete' => ['super admin'],
            'calibrations.verify' => ['super admin', 'approver'],
            
            // Log Kalibrasi
            'log.view' => ['super admin', 'teknisi', 'approver', 'checker'],
            'log.clean' => ['super admin'],
            
            // User Management
            'users.manage' => ['super admin'],
            
            // Master Data
            'master-data' => ['super admin'],
            
            // Dashboard
            'dashboard.view' => ['super admin', 'teknisi', 'approver', 'checker'],
            'dashboard.control' => ['super admin', 'checker', 'approver', 'ppic'],
        ];

        return $roles[$feature] ?? [];
    }

    /**
     * Cek role berdasarkan fitur
     */
    public static function allowFeatureOrFail($feature)
    {
        $roles = self::getAllowedRoles($feature);
        self::allowOrFail($roles, 'Anda tidak memiliki izin untuk fitur ' . $feature);
    }
}