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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = $this->residentService->storeRequest($request);

        if ($result) {
            return redirect()
                ->route('admin.residents-list')
                ->with('alert', [
                    'type' => 'success',
                    'message' => 'Resident added successfully.'
                ]);
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('alert', [
                'type' => 'danger',
                'message' => 'Failed to add resident. Please try again.'
            ]);
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
        $result = $this->residentService->updateRequest($request, $resident);

        if ($result) {
            return redirect()
            ->route('admin.residents-list')
            ->with('alert', [
                'type' => 'success',
                'message' => 'Resident information updated successfully!'
            ]);
        }
        
        
        return redirect()
            ->back()
            ->withInput()
            ->with('alert', [
                'type' => 'danger',
                'message' => 'Failed to update resident. Please try again.'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resident $resident)
    {
        $result = $this->residentService->deleteRequest($resident);

        if ($result) {
           return redirect()
            ->route('admin.residents-list')
            ->with('alert', [
                'type' => 'success',
                'message' => 'Resident information deleted successfully.'
            ]);
            
        }
        
        return redirect()
            ->back()
            ->with('alert', [
                'type' => 'danger',
                'message' => 'Failed to delete resident. Please try again.'
            ]);
    }
}