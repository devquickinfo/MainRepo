<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentListController extends Controller
{
    public function index(Request $request)
    {
        $schoolId = Auth::user()->school_id;


        /*
        |--------------------------------------------------------------------------
        | Classes
        |--------------------------------------------------------------------------
        */
        $classes = StudentClass::where('school_id', $schoolId)
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Sections
        |--------------------------------------------------------------------------
        */
        $sections = Section::where('school_id', $schoolId)
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
        ->where('school_id', $schoolId);


        /*
        |--------------------------------------------------------------------------
        | Class Filter
        |--------------------------------------------------------------------------
        */
        if ($request->filled('class')) {
            $studentsQuery->where(
                'class_id',
                $request->class
            );
        }


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


    
        if ($request->filled('idcardprinted')) {
            $studentsQuery->where('idcardprinted', $request->idcardprinted);
        }

      
        if ($request->student_photo === 'with_photo') {

            $studentsQuery->where(function ($query) {

                $query->where(function ($q) {
                    $q->whereNotNull('photo')
                      ->where('photo', '!=', '');
                })

                ->orWhere(function ($q) {
                    $q->whereNotNull('capturephoto')
                      ->where('capturephoto', '!=', '');
                });

            });
        }


       
        if ($request->student_photo === 'without_photo') {

            $studentsQuery->where(function ($query) {

                $query->where(function ($q) {
                    $q->whereNull('photo')
                      ->orWhere('photo', '');
                })

                ->where(function ($q) {
                    $q->whereNull('capturephoto')
                      ->orWhere('capturephoto', '');
                });

            });
        }
        
   
        $students = $studentsQuery
        ->orderBy('first_name')
        ->paginate(20)
        ->appends($request->query());

        return view(
            'frontend.studentlist',
            compact(
                'students',
                'classes',
                'sections'
            )
        );
    }
}

