<?php

namespace App\Services;

use App\Models\BrgyOfficials;
use App\Models\BrgyOfficialPosition;
use App\Models\BrgyCommitteePosition;
use App\Models\Purok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use Throwable;

class BrgyOfficialsService
{
    public function indexRequest(Request $request)
    {
        $brgyfficials = BrgyOfficials::with(['purok', 'position', 'committee'])
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('middle_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        $puroks = Purok::all();
        $brgy_positions = BrgyOfficialPosition::all();
        $committees = BrgyCommitteePosition::all();

        return view('admin.officials.index', compact('brgyfficials', 'puroks', 'brgy_positions', 'committees'));
    }

    // public function storeRequest(Request $request)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $validated = $request->validate([
    //             'first_name' => 'required|string|max:255',
    //             'middle_name' => 'required|string|max:255',
    //             'last_name' => 'required|string|max:255',
    //             'suffix' => 'nullable|in:jr,sr,ii,iii,iv,v',
    //             'email' => 'nullable|email|unique:brgy_officials,email',
    //             'phone_number' => 'nullable|string|max:20',
    //             'age' => 'nullable|integer|min:0|max:100',
    //             'birthdate' => 'nullable|date|before:today',
    //             'birthplace' => 'nullable|string|max:255',
    //             'gender' => 'nullable|in:male,female',
    //             'civil_status' => 'nullable|in:single,married,widowed,separated',
    //             'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //             'purok_id' => 'nullable|string|max:255',
    //             'term_start' => 'required|date',
    //             'position_id' => 'required|exists:positions,id',
    //             'committee_id' => 'nullable|exists:committee_position,id',
    //         ]);

    //         // Normalize
    //         $validated['gender'] = strtolower($validated['gender'] ?? null);
    //         $validated['civil_status'] = strtolower($validated['civil_status'] ?? null);
    //         $validated['suffix'] = strtolower($validated['suffix'] ?? null);
    //         $validated['age'] = Carbon::parse($validated['birthdate'])
    //             ->diffInYears(now());


    //         /** TERM LOGIC */
    //         $brgyposition = BrgyOfficialPosition::findOrFail($validated['position_id']);

    //         $termYears  = config('barangay.term_years');
    //         $termLimits = config('barangay.term_limits');

    //         $termStart = Carbon::parse($validated['term_start']);
    //         $termEnd   = $termStart->copy()->addYears($termYears);

    //         $termsHeld = BrgyOfficials::where('position_id', $brgyposition->id)
    //             ->where('first_name', $validated['first_name'])
    //             ->where('middle_name', $validated['middle_name'])
    //             ->where('last_name', $validated['last_name'])
    //             ->count();

    //         if (
    //             isset($termLimits[$brgyposition->name]) &&
    //             $termLimits[$brgyposition->name] !== null &&
    //             $termsHeld >= $termLimits[$brgyposition->name]
    //         ) {
    //             throw new \Exception(
    //                 "{$brgyposition->position} is limited to {$termLimits[$brgyposition->position]} terms only."
    //             );
    //         }

    //         $overlap = BrgyOfficials::where('position_id', $brgyposition->id)
    //             ->where('term_end', '>=', $termStart)
    //             ->exists();

    //         if ($overlap) {
    //             throw new \Exception("There is already an active {$brgyposition->position}.");
    //         }

    //         $validated['term_end'] = $termEnd;

    //         if ($request->hasFile('photo')) {
    //             $validated['photo'] = $request->file('photo')
    //                 ->store('brgy_officials_photos', 'public');
    //         }

    //         BrgyOfficials::create($validated);
    //         DB::commit();
    //     } catch (Throwable $e) {
    //         DB::rollBack();
    //         throw $e;
    //     }
    // }

    // public function storeRequest(Request $request)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $validated = $request->validate([
    //             'first_name'     => 'required|string|max:255',
    //             'middle_name'    => 'required|string|max:255',
    //             'last_name'      => 'required|string|max:255',
    //             'suffix'         => 'nullable|in:jr,sr,ii,iii,iv,v',
    //             'email'          => 'nullable|email|unique:brgy_officials,email',
    //             'phone_number'   => 'nullable|string|max:20',
    //             'birthdate'      => 'nullable|date|before:today',
    //             'birthplace'     => 'nullable|string|max:255',
    //             'gender'         => 'nullable|in:male,female',
    //             'civil_status'   => 'nullable|in:single,married,widowed,separated',
    //             'photo'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //             'purok_id'       => 'nullable|string|max:255',
    //             'term_start'     => 'required|date',
    //             'position_id'    => 'required|exists:positions,id',
    //             'committee_id'   => 'nullable|exists:committee_position,id',
    //         ]);

    //         /** NORMALIZE */
    //         foreach (['gender', 'civil_status', 'suffix'] as $field) {
    //             if (isset($validated[$field])) {
    //                 $validated[$field] = strtolower($validated[$field]);
    //             }
    //         }

    //         /** AGE (AUTO) */
    //         if (!empty($validated['birthdate'])) {
    //             $validated['age'] = Carbon::parse($validated['birthdate'])->age;
    //         }

    //         /** TERM LOGIC */
    //         $brgyposition = BrgyOfficialPosition::findOrFail($validated['position_id']);

    //         $termYears  = config('barangay.term_years');
    //         $termLimits = config('barangay.term_limits');

    //         $termStart = Carbon::parse($validated['term_start']);
    //         $termEnd   = $termStart->copy()->addYears($termYears);

    //         /** TERM LIMIT */
    //         $termsHeld = BrgyOfficials::where('position_id', $brgyposition->id)
    //             ->where('first_name', $validated['first_name'])
    //             ->where('middle_name', $validated['middle_name'])
    //             ->where('last_name', $validated['last_name'])
    //             ->count();

    //         if (
    //             isset($termLimits[$brgyposition->name]) &&
    //             $termLimits[$brgyposition->name] !== null &&
    //             $termsHeld >= $termLimits[$brgyposition->name]
    //         ) {
    //             throw new \Exception(
    //                 "{$brgyposition->name} is limited to {$termLimits[$brgyposition->position]} terms only."
    //             );
    //         }

    //         /** PREVENT ACTIVE OVERLAP */
    //         // $activeExists = BrgyOfficials::where('position_id', $brgyposition->id)
    //         //     ->where('term_end', '>=', now())
    //         //     ->exists();

    //         // if ($activeExists) {
    //         //     throw new \Exception("There is already an active {$brgyposition->position}.");
    //         // }

    //         $activeCount = BrgyOfficials::where('position_id', $brgyposition->id)
    //             ->where('term_end', '>=', now(), 'is_active', true)
    //             ->count();

    //         if ($activeCount >= $brgyposition->max_active) {
    //             throw new \Exception(
    //                 "Only {$brgyposition->max_active} active {$brgyposition->position}(s) allowed."
    //             );
    //         }


    //         $validated['term_end'] = $termEnd;

    //         /** PHOTO */
    //         if ($request->hasFile('photo')) {
    //             $validated['photo'] = $request->file('photo')
    //                 ->store('brgy_officials_photos', 'public');
    //         }

    //         BrgyOfficials::create($validated);

    //         DB::commit();
    //         return true;
    //     } catch (\Throwable $e) {
    //         DB::rollBack();
    //         throw $e;
    //     }
    // }

    public function storeRequest(Request $request)
    {
        DB::beginTransaction();

        try {
            /** VALIDATION */
            $validated = $request->validate([
                'first_name'   => 'required|string|max:255',
                'middle_name'  => 'required|string|max:255',
                'last_name'    => 'required|string|max:255',
                'suffix'       => 'nullable|in:jr,sr,ii,iii,iv,v',
                'email'        => 'nullable|email|unique:brgy_officials,email',
                'phone_number' => 'nullable|string|max:20',
                'birthdate'    => 'nullable|date|before:today',
                'birthplace'   => 'nullable|string|max:255',
                'gender'       => 'nullable|in:male,female',
                'civil_status' => 'nullable|in:single,married,widowed,separated',
                'photo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'purok_id'     => 'nullable|string|max:255',
                'term_start'   => 'required|date',
                'position_id'  => 'required|exists:positions,id',
                'committee_id' => 'nullable|exists:committee_position,id',
            ]);

            /** NORMALIZE ENUM FIELDS */
            foreach (['gender', 'civil_status', 'suffix'] as $field) {
                if (!empty($validated[$field])) {
                    $validated[$field] = strtolower($validated[$field]);
                }
            }

            /** AUTO AGE */
            if (!empty($validated['birthdate'])) {
                $validated['age'] = Carbon::parse($validated['birthdate'])->age;
            }

            /** POSITION */
            $position = BrgyOfficialPosition::select('id', 'position', 'max_active')
                ->findOrFail($validated['position_id']);


            /** TERM LOGIC */
            $termYears  = config('barangay.term_years');
            $termLimits = config('barangay.term_limits');

            $termStart = Carbon::parse($validated['term_start']);
            $termEnd   = $termStart->copy()->addYears($termYears);

            /** BASE QUERY (REUSABLE) */
            $baseQuery = BrgyOfficials::where('position_id', $position->id)
                ->where('first_name', $validated['first_name'])
                ->where('middle_name', $validated['middle_name'])
                ->where('last_name', $validated['last_name']);

            /** TERM LIMIT ENFORCEMENT */
            $termsHeld = (clone $baseQuery)
                ->where('term_end', '<', now())
                ->count();

            if (
                isset($termLimits[$position->position]) &&
                $termLimits[$position->position] !== null &&
                $termsHeld >= $termLimits[$position->position]
            ) {
                throw new \Exception(
                    "{$position->position} is limited to {$termLimits[$position->position]} terms only."
                );
            }

            /** MAX ACTIVE OFFICIALS ENFORCEMENT */
            $activeCount = BrgyOfficials::where('position_id', $position->id)
                ->where('term_end', '>=', now())
                ->count();

            if ($activeCount >= $position->max_active) {
                throw new \Exception(
                    "Only {$position->max_active} active {$position->position}(s) are allowed."
                );
            }


            /** FINAL DATA */
            $validated['term_end']  = $termEnd;

            /** PHOTO UPLOAD */
            if ($request->hasFile('photo')) {
                $validated['photo'] = $request
                    ->file('photo')
                    ->store('brgy_officials_photos', 'public');
            }

            /** CREATE RECORD */
            BrgyOfficials::create($validated);

            DB::commit();
            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }


    public function showRequest(BrgyOfficials $official)
    {
        return view('admin.officials.show', compact('official'));
    }

    // public function updateRequest(Request $request, BrgyOfficials $official)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $validated = $request->validate([
    //             'first_name'     => 'required|string|max:255',
    //             'middle_name'    => 'required|string|max:255',
    //             'last_name'      => 'required|string|max:255',
    //             'suffix'         => 'nullable|in:jr,sr,ii,iii,iv,v',
    //             'email'          => 'nullable|email|unique:brgy_officials,email,' . $official->id,
    //             'phone_number'   => 'nullable|string|max:20',
    //             'birthdate'      => 'nullable|date|before:today',
    //             'birthplace'     => 'nullable|string|max:255',
    //             'gender'         => 'nullable|in:male,female',
    //             'civil_status'   => 'nullable|in:single,married,widowed,separated',
    //             'photo'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //             'purok_id'       => 'nullable|string|max:255',
    //             'term_start'     => 'nullable|date',
    //             'position_id'    => 'nullable|exists:positions,id',
    //             'committee_id'   => 'nullable|exists:committee_position,id',
    //         ]);

    //         /** NORMALIZE */
    //         foreach (['gender', 'civil_status', 'suffix'] as $field) {
    //             if (isset($validated[$field])) {
    //                 $validated[$field] = strtolower($validated[$field]);
    //             }
    //         }

    //         /** AGE (AUTO) */
    //         if (!empty($validated['birthdate'])) {
    //             $validated['age'] = Carbon::parse($validated['birthdate'])->age;
    //         }

    //         /** TERM LOGIC (ONLY IF POSITION EXISTS) */
    //         if (!empty($validated['position_id']) && !empty($validated['term_start'])) {

    //             $position = BrgyOfficialPosition::findOrFail($validated['position_id']);

    //             $termYears  = config('barangay.term_years');
    //             $termLimits = config('barangay.term_limits');

    //             $termStart = Carbon::parse($validated['term_start']);
    //             $termEnd   = $termStart->copy()->addYears($termYears);

    //             /** TERM LIMIT (EXCLUDE CURRENT RECORD) */
    //             $termsHeld = BrgyOfficials::where('position_id', $position->id)
    //                 ->where('first_name', $validated['first_name'])
    //                 ->where('middle_name', $validated['middle_name'])
    //                 ->where('last_name', $validated['last_name'])
    //                 ->where('id', '!=', $official->id)
    //                 ->count();

    //             if (
    //                 isset($termLimits[$position->name]) &&
    //                 $termLimits[$position->name] !== null &&
    //                 $termsHeld >= $termLimits[$position->name]
    //             ) {
    //                 throw new \Exception(
    //                     "{$position->name} is limited to {$termLimits[$position->name]} terms only."
    //                 );
    //             }

    //             /** OVERLAP CHECK (EXCLUDE CURRENT RECORD) */
    //             $overlap = BrgyOfficials::where('position_id', $position->id)
    //                 ->where('id', '!=', $official->id)
    //                 ->where('term_end', '>=', $termStart)
    //                 ->exists();

    //             if ($overlap) {
    //                 throw new \Exception("There is already an active {$position->name}.");
    //             }

    //             $validated['term_end'] = $termEnd;
    //         }

    //         /** PHOTO */
    //         if ($request->hasFile('photo')) {
    //             $validated['photo'] = $request->file('photo')
    //                 ->store('brgy_officials_photos', 'public');
    //         }

    //         $official->update($validated);

    //         DB::commit();
    //         return true;
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         throw $e;
    //     }
    // }

    public function updateRequest(Request $request, BrgyOfficials $official)
    {
        $validated = $request->validate([
            'first_name'   => 'required|string|max:255',
            'middle_name'  => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'suffix'       => 'nullable|in:jr,sr,ii,iii,iv,v',
            'email'        => 'nullable|email|unique:brgy_officials,email,' . $official->id,
            'phone_number' => 'nullable|string|max:20',
            'birthdate'    => 'nullable|date|before:today',
            'birthplace'   => 'nullable|string|max:255',
            'gender'       => 'nullable|in:male,female',
            'civil_status' => 'nullable|in:single,married,widowed,separated',
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'purok_id'     => 'nullable|string|max:255',
            'term_start'   => 'nullable|date',
            'position_id'  => 'nullable|exists:positions,id',
            'committee_id' => 'nullable|exists:committee_position,id',
        ]);

        /** NORMALIZE */
        foreach (['gender', 'civil_status', 'suffix'] as $field) {
            if (isset($validated[$field])) {
                $validated[$field] = strtolower($validated[$field]);
            }
        }

        /** AGE */
        if (!empty($validated['birthdate'])) {
            $validated['age'] = Carbon::parse($validated['birthdate'])->age;
        }

        /** TERM LOGIC (ONLY IF CHANGED) */
        $positionChanged  = isset($validated['position_id']) && $validated['position_id'] != $official->position_id;
        $termStartChanged = isset($validated['term_start']) && $validated['term_start'] != $official->term_start;

        if ($positionChanged || $termStartChanged) {

            $position = BrgyOfficialPosition::findOrFail(
                $validated['position_id'] ?? $official->position_id
            );

            $termYears  = config('barangay.term_years');
            $termLimits = config('barangay.term_limits');

            $termStart = Carbon::parse($validated['term_start'] ?? $official->term_start);
            $termEnd   = $termStart->copy()->addYears($termYears);

            /** TERM LIMIT (COMPLETED TERMS ONLY) */
            $termsHeld = BrgyOfficials::where('position_id', $position->id)
                ->where('first_name', $validated['first_name'])
                ->where('middle_name', $validated['middle_name'])
                ->where('last_name', $validated['last_name'])
                ->where('id', '!=', $official->id)
                ->where('term_end', '<', now())
                ->count();

            if (
                isset($termLimits[$position->name]) &&
                $termLimits[$position->name] !== null &&
                $termsHeld >= $termLimits[$position->name]
            ) {
                throw new \Exception(
                    "{$position->position} is limited to {$termLimits[$position->name]} terms only."
                );
            }

            /** ACTIVE COUNT (Punong = 1, Kagawad = 7) */
            $activeCount = BrgyOfficials::where('position_id', $position->id)
                ->where('id', '!=', $official->id)
                ->where('term_end', '>=', now())
                ->count();

            if ($activeCount >= $position->max_active) {
                throw new \Exception(
                    "Only {$position->max_active} active {$position->position}(s) allowed."
                );
            }

            $validated['term_end'] = $termEnd;
        }

        /** PHOTO */
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('brgy_officials_photos', 'public');
        }

        DB::transaction(function () use ($official, $validated) {
            $official->update($validated);
        });

        return true;
    }


    // public function deleteRequest(BrgyOfficials $official)
    // {
    //     DB::beginTransaction();
    //     try {
    //         // Delete photo from storage if exists
    //         if ($official->photo) {
    //             $photoPath = str_replace('/storage/', 'public/', $official->photo);
    //             Storage::delete($photoPath);
    //         }

    //         $official->delete();
    //         DB::commit();
    //         return true;
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         return false;
    //     }
    // }

    public function deleteRequest(BrgyOfficials $official)
    {
        if ($official->term_end >= now()) {
            throw new \Exception(
                "You cannot delete an active barangay official."
            );
        }

        // Delete photo from storage if exists
        if ($official->photo) {
            $photoPath = str_replace('/storage/', 'public/', $official->photo);
            Storage::delete($photoPath);
        }

        DB::transaction(function () use ($official) {
            $official->terms()->delete();
            $official->delete();
        });

        return true;
    }
}