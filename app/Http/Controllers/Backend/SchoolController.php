<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\School;
use App\Models\Section;
use App\Models\StudentClass;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\SelectedSample;

class SchoolController extends Controller
{
   public function index()
    {
        $user = Auth::user();

        if ($user && $user->role === 'school' && $user->school_id) {
            $school = School::findOrFail($user->school_id);

            return redirect()->route('schools.show', $school);
        }

        $schools = School::latest()->paginate(10);

        return view(
            'schools.index',
            compact('schools')
        );
    }



    public function create()
    {
        return view('schools.create');
    }



    public function store(Request $request)
    {

        // $request->validate([
        //     'school_name'=>'required',
        //     'school_code'=>'required|unique:schools',
        //     'email'=>'nullable|email',
        //     'school_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        // ]);
        $validator = Validator::make($request->all(), [
            'school_name' => 'required',
            'school_code' => 'required|unique:schools',
            'email' => 'nullable|email',
            'school_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only([
            'school_name',
            'school_code',
            'email',
            'phone',
            'address',
            'city',
            'state',
            'pincode',
            'status',
        ]);

        if ($request->hasFile('school_logo')) {
            $data['logo'] = $request->file('school_logo')->store('schools', 'public');
        }

        $school = School::create($data);

        if (!empty($school->email)) {
            User::create([
                'name' => $school->school_name,
                'email' => $school->email,
                'password' => Hash::make('password'),
                'role' => 'school',
                'school_id' => $school->id,
            ]);
        }

         return redirect()
        ->route('schools.show', ['school' => Auth::user()->school_id])
        ->with('success', 'School Added Successfully');

    }



    public function show(School $school)
    {
        $user = Auth::user();

        if (
            $user &&
            $user->role === 'school' &&
            $user->school_id &&
            $user->school_id !== $school->id
        ) {
            abort(403);
        }

        $classes = StudentClass::with('sections')
            ->withCount([
                'students as students_count' => function ($query) use ($school) {
                    $query->where('school_id', $school->id);
                },
                'students as without_photo_count' => function ($query) use ($school) {
                    $query->where('school_id', $school->id)
                        ->whereNull('capturephoto');
                },
            ])
            ->get();

        return view('schools.show', compact('school', 'classes'));
    }

    public function edit(School $school)
    {
        return view(
            'schools.edit',
            compact('school')
        );
    }

    public function profile()
    {
        $user = Auth::user();

        if (! $user || $user->role !== 'school' || ! $user->school_id) {
            abort(403);
        }

        $school = $user->school;
        $schoolUser = User::where('role', 'school')->where('school_id', $school->id)->first();

        return view('schools.profile', compact('school', 'schoolUser'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if (! $user || $user->role !== 'school' || ! $user->school_id) {
            abort(403);
        }

        $school = $user->school;
        $schoolUser = User::where('role', 'school')->where('school_id', $school->id)->first();

        $request->validate([
            'school_name' => 'required',
            'school_code' => 'required|unique:schools,school_code,' . $school->id,
            'email' => 'required|email',
            'principal_name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'username' => 'required|string|unique:users,email,' . ($schoolUser?->id ?? 'NULL'),
            'password' => 'nullable|min:6|confirmed',
            'school_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);
       if ($request->hasFile('school_logo')) {

            if ($school->logo && Storage::disk('public')->exists($school->logo)) {
                Storage::disk('public')->delete($school->logo);
            }

            $data['logo'] = $request->file('school_logo')->store('schools', 'public');
        }

        $school->update([
            'school_name' => $request->school_name,
            'school_code' => $request->school_code,
            'email' => $request->email,
            'principal_name' => $request->principal_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $school->status,
            'logo' => $data['logo'] ?? $school->logo,
        ]);

        if ($schoolUser) {
            $schoolUser->update([
                'name' =>  $school->school_name,
                'email' => $request->username,
            ]);

            if ($request->filled('password')) {
                $schoolUser->update([
                    'password' => Hash::make($request->password),
                ]);
            }
        }

         return redirect()
        ->route('schools.show', ['school' => Auth::user()->school_id])
        ->with('success', 'School Updated Successfully');
    }


    public function update(Request $request, School $school)
    {
        $user = Auth::user();
        if ($user && $user->role === 'school' && $user->school_id && $user->school_id !== $school->id) {
            abort(403);
        }
       $validator = Validator::make($request->all(), [
            'school_name' => 'required',
            'school_code' => 'required|unique:schools,school_code,' . $school->id,
            'email' => 'nullable|email',
            'school_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

       if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        

        $schoolLogoFile = $request->file('school_logo');
        
        $data = $request->only([
            'school_name',
            'school_code',
            'email',
            'phone',
            'address',
            'city',
            'state',
            'pincode',
            'status',
        ]);

        $data['status'] = (bool) $request->input('status', $school->status);
    

        if ($schoolLogoFile instanceof \Illuminate\Http\UploadedFile && $schoolLogoFile->isValid()) {
            if ($school->logo && Storage::disk('public')->exists($school->logo)) {
                Storage::disk('public')->delete($school->logo);
            }

            $data['logo'] = $schoolLogoFile->store('schools', 'public');
        } else {
            $data['logo'] = $school->logo;
        }

        $school->update($data);
       dd($student->fresh()->photo);
        $schoolUser = User::where('role', 'school')
            ->where('school_id', $school->id)
            ->first();

        if ($schoolUser) {
            $schoolUser->update([
                'name' => $school->school_name,
                'email' => $school->email ?: $schoolUser->email,
            ]);
        }

        return redirect()
            ->route('schools.show', $school)
            ->with('success','School Updated Successfully');

    }
  
      
    public function destroy(School $school)
    {
        $school->update([
            'status' => ! $school->status,
        ]);

        $message = $school->status ? 'School activated successfully.' : 'School deactivated successfully.';

        return redirect()
            ->route('schools.index')
            ->with('success', $message);
    }
    public function saveSample(Request $request)
    {
        $schoolId = Auth::user()->school_id;
        $sampleId = $request->input('sample_id');

        if (!$schoolId || !$sampleId) {
            return redirect()->back()->with('error', 'Invalid school or sample selection.');
        }
        $existingRecord = SelectedSample::where('school_id', $schoolId)->first();
        if ($existingRecord) {
            // Update the existing record with the new sample ID
            $existingRecord->update(['sample_id' => $sampleId]);
        } else {
            // Create a new record
            SelectedSample::create([
                'school_id' => $schoolId,
                'sample_id' => $sampleId,
            ]);
        }
        return redirect()->back()->with('success', 'Sample selected successfully.');
    }
}
