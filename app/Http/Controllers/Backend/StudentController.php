<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['studentClass', 'section'])
                    ->latest()
                    ->paginate(10);
        $classes = StudentClass::all();
        $sections = Section::selectRaw('MIN(id) as id, name')
            ->groupBy('name')
            ->orderBy('id', 'ASC')
            ->get();

        return view('frontend.addstudent', compact('students', 'classes', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = StudentClass::all();
        $sections = Section::all();
        $students = Student::with(['studentClass', 'section'])->latest()->paginate(10);

        return view('frontend.addstudent', compact('students', 'classes', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admission_no'  => 'required|unique:students,admission_no',
            'first_name'    => 'required',
            'father_name'   => 'required',
            'date_of_birth' => 'required|date',
            'gender'        => 'required',
            'class_id'      => 'required',
            'section_id'    => 'required',
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $photo = null;
        $capturePhoto = null;
        $capturedByCamera = false;

        /*
        |--------------------------------------------------------------------------
        | Camera Image
        |--------------------------------------------------------------------------
        */
        if ($request->filled('photo_data')) {

            $image = $request->photo_data;

            // Remove base64 prefix
            $image = preg_replace(
                '/^data:image\/\w+;base64,/',
                '',
                $image
            );

            $image = str_replace(' ', '+', $image);

            $imageName = time() . '.png';

            Storage::disk('public')->put(
                'capture-photo/' . $imageName,
                base64_decode($image)
            );

            $capturePhoto = 'capture-photo/' . $imageName;
            $capturedByCamera = true;
        }

        /*
        |--------------------------------------------------------------------------
        | Uploaded Image
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('photo')) {

            $photo = $request->file('photo')->store(
                'student-photo',
                'public'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Create Student
        |--------------------------------------------------------------------------
        */
        Student::create([
            'school_id'          => Auth::user()->school_id,
            'admission_no'       => $request->admission_no,
            'first_name'         => $request->first_name,
            'last_name'          => $request->last_name,
            'father_name'        => $request->father_name,
            'address'            => $request->address,
            'gender'             => $request->gender,
            'date_of_birth'      => $request->date_of_birth,
            'blood_group'        => $request->blood_group,
            'phone'              => $request->phone,
            'class_id'           => $request->class_id,
            'section_id'         => $request->section_id,

            // Both can exist
            'photo'              => $photo,
            'capturephoto'       => $capturePhoto,

            'capture_background' => $request->capture_background ?? 'Sky Blue',
            'captured_by_camera' => $capturedByCamera,
        ]);

        return redirect()
            ->route('schools.classes.students', [
                'school' => Auth::user()->school_id,
                'class'  => $request->class_id,
            ])
            ->with('success', 'Student updated successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        $classes = StudentClass::all();
        $sections = Section::selectRaw('MIN(id) as id, name')
            ->groupBy('name')
            ->orderBy('id', 'ASC')
            ->get();
        $students = Student::with(['studentClass', 'section'])->latest()->paginate(10);

        return view('frontend.addstudent', compact(
            'student',
            'students',
            'classes',
            'sections'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     $student = Student::findOrFail($id);
    //     $validator = Validator::make($request->all(),[
    //         'admission_no' => 'required|unique:students,admission_no,' . $student->id,
    //         'first_name'   => 'required',
    //         'father_name'  => 'required',
    //         'date_of_birth' => 'required|date',
    //         'gender'       => 'required',
    //         'class_id'     => 'required',
    //         'section_id'   => 'required',
    //         'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
    //     ]);
    //     if ($validator->fails()) {
    //         return redirect()
    //             ->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }
    //     $photo = $student->photo;
    //     $capturePhoto = $student->capturephoto;
    //     $capturedByCamera = $student->captured_by_camera;

    //     // New camera capture
    //     if ($request->filled('photo_data')) {
    //         if ($photo && Storage::disk('public')->exists($photo)) {
    //             Storage::disk('public')->delete($photo);
    //         }

    //         if ($capturePhoto && Storage::disk('public')->exists($capturePhoto)) {
    //             Storage::disk('public')->delete($capturePhoto);
    //         }

    //         $image = str_replace('data:image/png;base64,', '', $request->photo_data);
    //         $image = str_replace(' ', '+', $image);

    //         $imageName = time() . '.png';

    //         Storage::disk('public')->put(
    //             'capture-photo/' . $imageName,
    //             base64_decode($image)
    //         );

    //         $capturePhoto = 'capture-photo/' . $imageName;
    //         $photo = null;
    //         $capturedByCamera = true;
    //     }

    //     // New uploaded file
    //     elseif ($request->hasFile('photo')) {
    //         if ($photo && Storage::disk('public')->exists($photo)) {
    //             Storage::disk('public')->delete($photo);
    //         }

    //         if ($capturePhoto && Storage::disk('public')->exists($capturePhoto)) {
    //             Storage::disk('public')->delete($capturePhoto);
    //         }

    //         $photo = $request->file('photo')->store('student-photo', 'public');
    //         $capturePhoto = null;
    //         $capturedByCamera = false;
    //     }

    //     $student->update([
    //         'admission_no'       => $request->admission_no,
    //         'first_name'         => $request->first_name,
    //         'last_name'          => $request->last_name,
    //         'father_name'        => $request->father_name,
    //         'address'            => $request->address,
    //         'gender'             => $request->gender,
    //         'date_of_birth'      => $request->date_of_birth,
    //         'blood_group'        => $request->blood_group,
    //         'phone'              => $request->phone,
    //         'class_id'           => $request->class_id,
    //         'section_id'         => $request->section_id,
    //         'photo'              => $photo,
    //         'capturephoto'       => $capturePhoto,
    //         'capture_background' => $request->capture_background ?? 'Sky Blue',
    //         'captured_by_camera' => $capturedByCamera,
    //     ]);

    //     return redirect()
    //         ->route('students.index')
    //         ->with('success', 'Student updated successfully.');
    // }
    
        public function update(Request $request, string $id)
        {
            $student = Student::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'admission_no'  => 'required|unique:students,admission_no,' . $student->id,
                'first_name'    => 'required',
                'father_name'   => 'required',
                'date_of_birth' => 'required|date',
                'gender'        => 'required',
                'class_id'      => 'required',
                'section_id'    => 'required',
                'photo'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Keep existing values
            $photo = $student->photo;
            $capturePhoto = $student->capturephoto;
            $capturedByCamera = $student->captured_by_camera;

            /*
            |--------------------------------------------------------------------------
            | New Camera Capture
            |--------------------------------------------------------------------------
            */
            if ($request->filled('photo_data')) {

                // Delete ONLY old capture photo
                if (
                    $capturePhoto &&
                    Storage::disk('public')->exists($capturePhoto)
                ) {
                    Storage::disk('public')->delete($capturePhoto);
                }

                $image = str_replace(
                    'data:image/png;base64,',
                    '',
                    $request->photo_data
                );

                $image = str_replace(' ', '+', $image);

                $imageName = time() . '.png';

                Storage::disk('public')->put(
                    'capture-photo/' . $imageName,
                    base64_decode($image)
                );

                $capturePhoto = 'capture-photo/' . $imageName;

                // IMPORTANT:
                // Keep existing uploaded photo
                $capturedByCamera = true;
            }

            /*
            |--------------------------------------------------------------------------
            | New Uploaded Photo
            |--------------------------------------------------------------------------
            */
            elseif ($request->hasFile('photo')) {

                // Delete ONLY old uploaded photo
                if (
                    $photo &&
                    Storage::disk('public')->exists($photo)
                ) {
                    Storage::disk('public')->delete($photo);
                }

                // Save new uploaded photo
                $photo = $request->file('photo')->store(
                    'student-photo',
                    'public'
                );

                // IMPORTANT:
                // Keep existing capture photo
                $capturedByCamera = false;
            }

            /*
            |--------------------------------------------------------------------------
            | Update Student
            |--------------------------------------------------------------------------
            */
            $student->update([
                'admission_no'       => $request->admission_no,
                'first_name'         => $request->first_name,
                'last_name'          => $request->last_name,
                'father_name'        => $request->father_name,
                'address'            => $request->address,
                'gender'             => $request->gender,
                'date_of_birth'      => $request->date_of_birth,
                'blood_group'        => $request->blood_group,
                'phone'              => $request->phone,
                'class_id'           => $request->class_id,
                'section_id'         => $request->section_id,

                // Both values are preserved
                'photo'              => $photo,
                'capturephoto'       => $capturePhoto,

                'capture_background' => $request->capture_background ?? 'Sky Blue',
                'captured_by_camera' => $capturedByCamera,
            ]);

            // return redirect()
            //     ->route('students.index')
            //     ->with('success', 'Student updated successfully.');
          return redirect()
            ->route('schools.classes.students', [
                'school' => Auth::user()->school_id,
                'class'  => $student->class_id,
            ])
            ->with('success', 'Student updated successfully.');
        }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')
            ->with('success','Student Deleted Successfully');
    }
    public function getSections($classId)
    {
        $sections = Section::where('class_id', $classId)
            ->orderBy('name')
            ->get();

        return response()->json($sections);
    }

    public function schoolClasses()
    {
        $user = Auth::user();

        // Sections are global; load all sections for each class
        $classes = StudentClass::with('sections')->get();

        return view('frontend.school_classes', compact('classes'));
    }

    public function classSectionStudents($classId, $sectionId)
    {
        $class = StudentClass::findOrFail($classId);
        $section = Section::findOrFail($sectionId);

        $students = Student::where('class_id', $classId)
            ->where('section_id', $sectionId)
            ->orderBy('first_name')
            ->get();

        return view('frontend.class_section_students', compact('class', 'section', 'students'));
    }

  
    public function classStudents(Request $request, $schoolId, $classId)
    {
        $school = School::findOrFail($schoolId);

        /*
        |--------------------------------------------------------------------------
        | Determine Selected Class
        |--------------------------------------------------------------------------
        */

        $selectedClassId = $request->filled('class')
            ? $request->class
            : $classId;

        $class = StudentClass::where('school_id', $school->id)
            ->findOrFail($selectedClassId);


        /*
        |--------------------------------------------------------------------------
        | Classes
        |--------------------------------------------------------------------------
        */

        $classes = StudentClass::where('school_id', $school->id)
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Students Query
        |--------------------------------------------------------------------------
        */

        $studentsQuery = Student::with([
                'studentClass',
                'section'
            ])
            ->where('school_id', $school->id)
            ->where('class_id', $class->id)
            ->orderBy('first_name');


        /*
        |--------------------------------------------------------------------------
        | Section Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('section')) {
            $studentsQuery->where(
                'section_id',
                $request->section
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Capture Photo Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('photo_filter')) {

            if ($request->photo_filter === 'with_photo') {

                $studentsQuery->where(function ($query) {
                    $query->whereNotNull('capturephoto')
                        ->where('capturephoto', '!=', '');
                });

            } elseif ($request->photo_filter === 'without_photo') {

                $studentsQuery->where(function ($query) {
                    $query->whereNull('capturephoto')
                        ->orWhere('capturephoto', '');
                });
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Student Photo Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('student_photo')) {

            if ($request->student_photo === 'with_photo') {

                $studentsQuery->where(function ($query) {
                    $query->whereNotNull('photo')
                        ->where('photo', '!=', '');
                });

            } elseif ($request->student_photo === 'without_photo') {

                $studentsQuery->where(function ($query) {
                    $query->whereNull('photo')
                        ->orWhere('photo', '');
                });
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Sections
        |--------------------------------------------------------------------------
        */

        $sections = Section::where('school_id', $school->id)
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $students = $studentsQuery
            ->paginate(10)
            ->appends($request->query());


        return view(
            'frontend.class_students',
            compact(
                'school',
                'class',
                'students',
                'sections',
                'classes'
            )
        );
    }


}
