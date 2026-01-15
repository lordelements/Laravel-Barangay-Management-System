<?php

use App\Models\AuditTrail;
use Illuminate\Support\Facades\Auth;

if (!function_exists('logAudit')) {
    function logAudit(string $action, string $activity)
    {
        $user = Auth::user();

        AuditTrail::create([
            'user_id' => $user->id ?? null,
            'name'    => $user->name ?? 'Guest',
            'email'   => $user->email ?? null,
            'role'    => $user->role ?? null,
            'date'    => now()->toDateString(),
            'action'  => $action,      // CREATE, UPDATE, DELETE, LOGIN
            'activity' => $activity,    // Residents, Officials, Puroks, etc.
        ]);
    }
}