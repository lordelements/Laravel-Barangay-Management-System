<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use Illuminate\Http\Request;
use App\Services\ResidentService;

class ResidentController extends Controller
{
    protected $residentService;

    public function __construct(ResidentService $residentService)
    {
        $this->residentService = $residentService;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->residentService->indexRequest($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->residentService->storeRequest($request);
        
        return redirect()
            ->route('admin.residents-list')
            ->with('success', 'Resident added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Resident $resident)
    {
        return $this->residentService->showRequest($resident);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Resident $resident)
    // {
    //     return $this->residentService->editRequest($resident);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resident $resident)
    {
        $this->residentService->updateRequest($request, $resident);
        
        return redirect()
            ->route('admin.residents-list')
            ->with('success', 'Resident updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resident $resident)
    {
         $this->residentService->deleteRequest($resident);
        
        return redirect()
            ->route('admin.residents-list')
            ->with('success', 'Resident deleted successfully.');
    }
}