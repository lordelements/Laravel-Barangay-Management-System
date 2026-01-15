<?php

namespace App\Services;

use App\Models\Resident;
use App\Models\Purok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;
use App\Services\AuditTrailService;

class ResidentService
{
    public function indexRequest(Request $request)
    {
        $residents = Resident::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('middle_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString(); // keep search during pagination

        $puroks = Purok::all();

        return view('admin.residents.index', compact('residents', 'puroks'));
    }

    public function storeRequest(Request $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'middle_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'suffix' => 'nullable|in:jr,sr,ii,iii,iv,v',
                'email' => 'nullable|email|unique:residents,email',
                'phone_number' => 'nullable|string|max:20',
                'birthdate' => 'nullable|date|before:today',
                'birthplace' => 'nullable|string|max:255',
                'gender' => 'nullable|in:male,female',
                'civil_status' => 'nullable|in:single,married,widowed,separated',
                'voter_status' => 'nullable|in:registered_voter,non_voter',
                'description' => 'nullable|string|max:255',
                'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'purok_id'   => 'nullable|string|max:255',
            ]);

            /** NORMALIZE ENUM FIELDS */
            foreach (['gender', 'civil_status', 'suffix', 'voter_status'] as $field) {
                if (!empty($validated[$field])) {
                    $validated[$field] = strtolower($validated[$field]);
                }
            }

            /** AUTO AGE */
            if (!empty($validated['birthdate'])) {
                $validated['age'] = Carbon::parse($validated['birthdate'])->age;
            }

            if ($request->hasFile('photo')) {
                $validated['photo'] = $request->file('photo')
                    ->store('residents', 'public');
            }

            Resident::create($validated);

            DB::commit();
            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function showRequest(Resident $resident)
    {
        return view('admin.residents.show', compact('resident'));
    }

    public function updateRequest(Request $request, Resident $resident)
    {
        $validated = $request->validate([
            'first_name'     => 'required|string|max:255',
            'middle_name'    => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'suffix'         => 'nullable|in:jr,sr,ii,iii,iv,v',

            'email'          => 'nullable|email|unique:residents,email,' . $resident->id,
            'phone_number'   => 'nullable|string|max:20',

            'birthdate'      => 'nullable|date|before:today',
            'birthplace'     => 'nullable|string|max:255',
            'purok_id'       => 'nullable|string|max:255',

            'gender'         => 'nullable|in:male,female',
            'civil_status'   => 'nullable|in:single,married,widowed,separated',
            'voter_status'   => 'nullable|in:registered_voter,non_voter',

            'description'    => 'nullable|string|max:255',
            'photo'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        /** NORMALIZE ENUM FIELDS */
        foreach (['gender', 'civil_status', 'suffix', 'voter_status'] as $field) {
            if (!empty($validated[$field])) {
                $validated[$field] = strtolower($validated[$field]);
            }
        }

        /** AUTO AGE */
        if (!empty($validated['birthdate'])) {
            $validated['age'] = Carbon::parse($validated['birthdate'])->age;
        }

        /** UPDATE PHOTO */
        if ($request->hasFile('photo')) {
            if ($resident->photo && Storage::disk('public')->exists($resident->photo)) {
                Storage::disk('public')->delete($resident->photo);
            }

            $validated['photo'] = $request->file('photo')
                ->store('residents', 'public');
        }

        DB::transaction(function () use ($resident, $validated) {
            $resident->update($validated);
        });

        return true;
    }


    // public function deleteRequest(Resident $resident)
    // {
    //     // Deleting a resident
    //     $oldData = $resident->toArray();
    //     $resident->delete();

    //     AuditTrailService::log(
    //         'Residents',                  // activity
    //         'Record deleted',             // description
    //         $oldData,                     // old values
    //         null                          // new values
    //     );

    //     return true;
    // }

    public function deleteRequest(Resident $resident): bool
    {
        try {
            $oldData = $resident->toArray(); // capture data before deletion

            $resident->delete(); // delete the record

            // Log deletion
            AuditTrailService::log(
                'Residents',
                'Record deleted',
                $oldData,
                null
            );

            return true; // indicate success
        } catch (\Exception $e) {
            // Optionally log error
            Log::error('Resident delete failed: ' . $e->getMessage());
            return false; // indicate failure
        }
    }
}