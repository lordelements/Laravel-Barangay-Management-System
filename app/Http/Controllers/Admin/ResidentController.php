<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resident as res;
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
    public function index()
    {
        return $this->residentService->indexFromRequest();
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
        $resident = new res();
        return $this->residentService->storeFromRequest($request, $resident);
    }

    /**
     * Display the specified resource.
     */
    public function show(res $resident)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(res $resident)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, res $resident)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(res $resident)
    {
        //
    }
}