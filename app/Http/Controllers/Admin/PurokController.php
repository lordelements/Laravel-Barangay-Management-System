<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purok;
use Illuminate\Support\Facades\DB;
use Exception;

class PurokController extends Controller
{
    public function index(Request $request)
    {
        $puroks = Purok::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('street', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.streets.index', [
            'puroks' => $puroks,
        ]);
    }

    public function store(Request $request)
    {
        // DB::beginTransaction();

        // try {
        //     $validated = $request->validate([
        //         'street' => 'required|string|max:255',
        //     ]);

        //    Purok::create($validated);

        //     return redirect()
        //     ->route('admin.streets-list')
        //     ->with('alert', [
        //         'type' => 'success',
        //         'message' => 'Purok added successfully!'
        //     ]);

        // } catch (Exception $e) {
        //     DB::rollBack();
        //     return false;
        // }

        $request->validate([
            'street' => 'required|string|max:255',
        ]);

        $purok = Purok::create([
            'street' => $request->street,
        ]);

        return redirect()
            ->route('admin.streets-list')
            ->with('alert', [
                'type' => 'success',
                'message' => 'Purok added successfully!'
            ]);
    }
}