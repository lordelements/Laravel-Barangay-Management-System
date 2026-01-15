<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\AuditTrail;
use App\Services\AuditTrailService;

class AuditTrailController extends Controller
{
    protected AuditTrailService $auditTrailService;

    public function __construct(AuditTrailService $auditTrailService)
    {
        $this->auditTrailService = $auditTrailService;
    }

    public function index(Request $request)
    {
        return $this->auditTrailService->visitors_logsindex(RequestFacade::getFacadeRoot());
    }
}