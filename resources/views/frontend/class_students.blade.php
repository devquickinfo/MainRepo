@extends('frontend.layout.applayout')
@section('title', 'Class Students')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $class->name }} Students</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('schools.show', $school) }}">{{ $school->school_name }}</a></li>
                        <li class="breadcrumb-item active">Students</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title">Student List</h3>
                    <a href="{{ route('students.create') }}" class="btn btn-sm btn-primary ml-auto">
                        Add Student
                    </a>
                </div>
                 @if(session('success'))
                    <div class="alert alert-success m-3 mb-0">
                    {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger m-3 mb-0">
                    {{ session('error') }}
                    </div>
                @endif
                <div class="card-body">
                    <form method="GET" action="{{ route('schools.classes.students', ['school' => $school->id, 'class' => $class->id]) }}" class="row g-2 align-items-end mb-3">
                        <div class="col-md-3">
                            <label class="form-label">Class</label>
                            <select id="class" class="form-control" onchange="this.form.submit()" name="class">
                                <option value="">Select Class</option>
                                @foreach($classes as $cls)
                                    <option value="{{ $cls->id }}"
                                        {{ $class->id == $cls->id ? 'selected' : '' }}>
                                        {{ $cls->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Section</label>
                            <select name="section" class="form-control" onchange="this.form.submit()">
                                <option value="">All Sections</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}" {{ request('section') == $section->id ? 'selected' : '' }}>
                                        {{ $section->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">IDCard Created</label>
                            <select name="photo_filter" class="form-control" onchange="this.form.submit()">
                                <option value="">All Students</option>
                                <option value="with_photo" {{ request('photo_filter') == 'with_photo' ? 'selected' : '' }}>Yes</option>
                                <option value="without_photo" {{ request('photo_filter') == 'without_photo' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                        <label class="form-label">Student Photo</label>
                        <select name="student_photo" class="form-control" onchange="this.form.submit()">
                            <option value="">All Students</option>
                            <option value="with_photo" {{ request('student_photo') == 'with_photo' ? 'selected' : '' }}>With Photo</option>
                            <option value="without_photo" {{ request('student_photo') == 'without_photo' ? 'selected' : '' }}>Without Photo</option>
                        </select>
                        </div>
                       
                    </form>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const classSelect = document.getElementById('classSelect');
                            if (classSelect) {
                                classSelect.addEventListener('change', function () {
                                    const selected = this.value;
                                    if (!selected) return;
                                    const schoolId = {{ $school->id }};
                                    window.location.href = `/schools/${schoolId}/classes/${selected}/students`;
                                });
                            }
                        });
                    </script>

                    @if($students->isEmpty())
                        <p class="text-muted">No students found for this class.</p>
                    @else
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <input type="text" id="studentSearch" class="form-control" placeholder="Search by Admission No, Name or Phone">
                            </div>
                             <div class="col-md-3">
                              <a href="{{ route('schools.classes.students', ['school' => $school->id, 'class' => $class->id]) }}" class="btn btn-secondary">Reset</a>
                             </div>
                        </div>
                        
                        <table class="table table-bordered table-striped" id="studentTable">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Admission No</th>
                                    <th>Name</th>
                                    <th>Section</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>
                                            @if($student->photo)
                                                <img src="{{ asset('storage/' . $student->photo) }}" alt="Student Photo" style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <span class="text-muted">No Photo</span>
                                            @endif
                                        </td>
                                        <td>{{ $student->admission_no }}</td>
                                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                        <td>{{ $student->section->name ?? 'N/A' }}</td>
                                        <td>{{ $student->gender }}</td>
                                        <td>{{ $student->phone }}</td>
                                        <td>
                                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this student?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }} results
                            </div>

                            <div>
                                {{ $students->links() }}
                            </div>
                        </div>
                        <!-- <div class="mt-3">
                            {{ $students->links() }}
                        </div> -->
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection



