<?php 

namespace App\Services;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ResidentService
{
    public function indexFromRequest()
    {
        $residents = Resident::all();
        return view('admin.residents.index', compact('residents'));
    }
    
    public function storeFromRequest(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|in:jr,sr,ii,iii,iv,v',

            'email' => 'nullable|email|unique:residents,email',
            'phone_number' => 'nullable|string|max:20',

            'age' => 'nullable|integer|min:0|max:150',
            'birthdate' => 'nullable|date',
            'birthplace' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',

            'gender' => 'nullable|in:male,female',
            'civil_status' => 'nullable|in:single,married,widowed,separated',
            'voter_status' => 'nullable|in:registered_voter,non_voter',

            'description' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // STORE PHOTO USING STORAGE
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('residents', 'public');
        }

        Resident::create($validated);

        return redirect()
            ->route('admin.residents-list')
            ->with('success', 'Resident added successfully.');
    }
}