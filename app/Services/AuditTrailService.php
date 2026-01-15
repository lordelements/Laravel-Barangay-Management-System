<?php

namespace App\Services;

use App\Models\AuditTrail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuditTrailService
{
    public static function log(
        string $activity,          // e.g., 'Authentication', 'Residents'
        string $description,       // e.g., 'User logged in'
        array $oldValues = null,
        array $newValues = null
    ): void {
        $user = Auth::user();

        // $description = match ($activity) {
        //     'LOGIN'  => 'User logged in',
        //     'LOGOUT' => 'User logged out',
        //     'CREATE' => 'Record created',
        //     'UPDATE' => 'Record updated',
        //     'DELETE' => 'Record deleted',
        //     default  => null,
        // };
        
        AuditTrail::create([
            'user_id' => $user?->id,
            'name' => $user?->name,
            'email' => $user?->email,
            'role' => $user?->role,
            'activity' => $activity,
            'description'=> $description,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'old_values' => $oldValues,
            'new_values' => $newValues,
        ]);

        
    }

    public function visitors_logsindex()
    {
        $query = AuditTrail::with('user');
        $auditTrails = $query->latest()->paginate(10);
        return view('admin.visitor_logs.index', compact('auditTrails'));
    }   
}