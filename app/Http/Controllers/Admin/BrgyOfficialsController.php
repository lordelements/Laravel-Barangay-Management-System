<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrgyOfficials as Official;
use App\Services\BrgyOfficialsService;
use Illuminate\Http\Request;

class BrgyOfficialsController extends Controller
{
    protected $brgyofficialsService;

    public function __construct(BrgyOfficialsService $brgyofficialsService)
    {
        $this->brgyofficialsService = $brgyofficialsService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->brgyofficialsService->indexRequest($request);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->brgyofficialsService->storeRequest($request);

            return redirect()
                ->route('admin.officials-list')
                ->with('alert', [
                    'type' => 'success',
                    'message' => 'Brgy Official added successfully!'
                ]);
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('alert', [
                    'type' => 'danger',
                    'message' => $e->getMessage()
                ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Official $official)
    {
        return $this->brgyofficialsService->showRequest($official);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Official $official)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Official $official)
    {

        try {
            $result = $this->brgyofficialsService->updateRequest($request, $official);

            if ($result) {
                return redirect()
                    ->route('admin.officials-list')
                    ->with('alert', [
                        'type' => 'success',
                        'message' => 'Brgy Official updated successfully!'
                    ]);
            }
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('alert', [
                    'type' => 'danger',
                    'message' => $e->getMessage()
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Official $official)
    {
        $result = $this->brgyofficialsService->deleteRequest($official);

        if ($result) {
            return redirect()
                ->route('admin.officials-list')
                ->with('alert', [
                    'type' => 'success',
                    'message' => 'Brgy Official deleted successfully!'
                ]);
        }

        return redirect()
            ->back()
            ->with('alert', [
                'type' => 'danger',
                'message' => 'Failed to delete Brgy Official. Please try again.'
            ]);

        try {
            $result = $this->brgyofficialsService->deleteRequest($official);

            if ($result) {
                return redirect()
                    ->route('admin.officials-list')
                    ->with('alert', [
                        'type' => 'success',
                        'message' => 'Brgy Official deleted successfully!'
                    ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type' => 'danger',
                'message' => $e->getMessage()
            ]);
        }
    }
}